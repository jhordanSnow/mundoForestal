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

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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
        $modelPhoto = new Photo();

        $characteristicData = ArrayHelper::map(Characteristic::find()->all(),'IdCharacteristic', 'Name');
        $familyList = ArrayHelper::map(Botanicalfamily::find()->all(),'IdFamily', 'Name');
        $typeList = ArrayHelper::map(Planttype::find()->all(),'IdType', 'Name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdPlant]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelChar' => $modelChar,
            'modelPhoto' => $modelPhoto,
            'typeList' => $typeList,
            'familyList' => $familyList,
            'characteristicList' => $characteristicData
        ]);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdPlant]);
        }

        return $this->render('update', [
            'model' => $model,
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
        $this->findModel($id)->delete();

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
