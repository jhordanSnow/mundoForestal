<?php

namespace backend\controllers;

use Yii;
use backend\models\Plant;
use backend\models\PlantSearch;
use backend\models\Botanicalfamily;
use backend\models\Characteristic;
use backend\models\PlantCharacteristic;
use backend\models\Photo;
use backend\models\Planttype;
use backend\models\MapInformation;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * PlantController implements the CRUD actions for Plant model.
 */
class PlantController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Plant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => $dataProvider->query,
            'pagination' => [ 'pageSize' => 5],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Plant model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Plant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Plant();
        $modelChar = new PlantCharacteristic();
        $modelMap = new MapInformation();
        $modelPhoto = new Photo();

        $characteristicData = ArrayHelper::map(Characteristic::find()->all(),'IdCharacteristic', 'Name');
        $familyList = ArrayHelper::map(Botanicalfamily::find()->all(),'IdFamily', 'Name');
        $typeList = ArrayHelper::map(Planttype::find()->all(),'IdType', 'Name');

        if (Yii::$app->request->isPost){
          $commit = true;
          $transaction = Yii::$app->db->beginTransaction();
          $postValues = Yii::$app->request->post();
          if ($model->load(Yii::$app->request->post()) && $model->save()){
            (array_key_exists("PlantCharacteristic",$postValues)) ? $commit = $this->InsertCharacteristics($model->IdPlant, $postValues["PlantCharacteristic"]) : '';
            $commit = $this->InsertPhotos($modelPhoto, $model->IdPlant,explode(',',$postValues["uploadFilesNames"]));
            (array_key_exists("MapInformation",$postValues)) ? $commit = $this->InsertGeolocation($model->IdPlant, $postValues["MapInformation"]) : '';
          }
          if ($commit){
            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Planta creada correctamente.');
            return $this->redirect(['update', 'id' => $model->IdPlant]);
          }else{
            $transaction->rollback();
            Yii::$app->session->setFlash('success', 'Ocurrio un error al crear la planta.');
          }
        }

        return $this->render('create', [
            'model' => $model,
            'modelChar' => $modelChar,
            'modelPhoto' => $modelPhoto,
            'modelMap' => $modelMap,
            'typeList' => $typeList,
            'familyList' => $familyList,
            'characteristicList' => $characteristicData
        ]);
    }

    public function DeleteCharacteristics($idPlant, $listCharacteristics){
      $commit = true;
      if (!PlantCharacteristic::deleteAll(['IdPlant' => $idPlant])){
        $commit = false;
      }
      return $commit;
    }

    public function InsertCharacteristics($idPlant, $listCharacteristics){
      $commit = true;
      $listValues = [];
      for ($i=0; $i < count($listCharacteristics["Value"]); $i++) {
        $listValues[$i] = [$listCharacteristics["Value"][$i], $listCharacteristics["IdCharacteristic"][$i], $idPlant];
      }
      if(Yii::$app->db->createCommand()->batchInsert("plantcharacteristic", ["Value", "IdCharacteristic", "IdPlant"], $listValues)->execute() <= 0){
        $commit = false;
      }
      return $commit;
    }

    public function DeleteGeolocation($idPlant){
      $commit = true;
      if (!MapInformation::deleteAll(['IdPlant' => $idPlant])){
        $commit = false;
      }
      return $commit;
    }

    public function InsertGeolocation($idPlant, $listMapInformation){
      $commit = true;
      $listValues = [];
      for ($i=0; $i < count($listMapInformation["Polygon"]); $i++) {
        $listValues[$i] = [$listMapInformation["Polygon"][$i], $idPlant];
      }
      if(Yii::$app->db->createCommand()->batchInsert("mapinformation", ["Polygon", "IdPlant"], $listValues)->execute() <= 0){
        $commit = false;
      }
      return $commit;
    }

    public function InsertPhotos($model, $idPlant, $listInserted){
      $commit = true;
      $model->photos = UploadedFile::getInstances($model,'photos');
      if (!$model->upload($idPlant, $listInserted)){
        $commit = false;
      }
      return $commit;
    }

    public function DeletePhotos($model, $listInserted){
      $commit = true;
      echo '<pre>';
      foreach ($model->photos as $photo) {
        if (!in_array($photo->Photo, $listInserted)){
          if (!Photo::deleteAll(["IdPhoto" => $photo->IdPhoto])){
            $commit = false;
          }else{
            unlink(Yii::getAlias('@backend'). '/web/Images/'.$photo->Photo);
          }
        }
      }
      return $commit;
    }

    /**
     * Updates an existing Plant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new Plant();
        $modelChar = new PlantCharacteristic();
        $modelPhoto = new Photo();
        $model = $this->findModel($id);

        $characteristicData = ArrayHelper::map(Characteristic::find()->where(['not in', 'IdCharacteristic', $model->plantcharacteristics])->all(),'IdCharacteristic', 'Name');
        $familyList = ArrayHelper::map(Botanicalfamily::find()->all(),'IdFamily', 'Name');
        $typeList = ArrayHelper::map(Planttype::find()->all(),'IdType', 'Name');

        if (Yii::$app->request->isPost){
          $commit = true;
          $transaction = Yii::$app->db->beginTransaction();
          $postValues = Yii::$app->request->post();
          if ($model->load($postValues) && $model->save()){
            (count($model->plantcharacteristics) > 0) ? $commit = $this->DeleteCharacteristics($model->IdPlant, $model->plantcharacteristics) : '';
            (array_key_exists("PlantCharacteristic", $postValues)) ? $commit = $this->InsertCharacteristics($model->IdPlant, $postValues["PlantCharacteristic"]) : '';
            $commit = $this->DeletePhotos($model, explode(',',$postValues["uploadFilesNames"]));
            $commit = $this->InsertPhotos($modelPhoto, $model->IdPlant,explode(',',$postValues["uploadFilesNames"]));

            (count($model->mapinformations) > 0) ? $commit = $this->DeleteGeolocation($model->IdPlant) : '';
            (array_key_exists("MapInformation",$postValues)) ? $commit = $this->InsertGeolocation($model->IdPlant, $postValues["MapInformation"]) : '';
            //$commit = InsertGeolocation($postValues["Photos"]);
          }
          if ($commit){
            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Planta actualizada correctamente.');
            return $this->redirect(['update', 'id' => $model->IdPlant]);
          }else{
            $transaction->rollback();
            Yii::$app->session->setFlash('success', 'Ocurrio un error al actualizar la planta.');
            return $this->redirect(['index']);
          }
        }

        return $this->render('update', [
            'model' => $model,
            'modelChar' => $modelChar,
            'modelPhoto' => $modelPhoto,
            'typeList' => $typeList,
            'familyList' => $familyList,
            'characteristicList' => $characteristicData
        ]);
    }

    /**
     * Deletes an existing Plant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      $photos = ArrayHelper::map($model->photos, 'IdPhoto', 'Photo');
      if ($model->delete()){
        foreach ($photos as $photo) {
          unlink(Yii::getAlias('@backend'). '/web/Images/'.$photo);
        }
        Yii::$app->session->setFlash('success', 'Planta eleminada correctamente.');
      }else{
        Yii::$app->session->setFlash('error', 'Ocurrió un error al eliminar la planta.');
      }
      return $this->redirect(['index']);
    }

    /**
     * Finds the Plant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Plant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
