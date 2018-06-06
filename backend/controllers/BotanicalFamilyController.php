<?php

namespace backend\controllers;

use Yii;
use backend\models\BotanicalFamily;
use backend\models\BotanicalFamilySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;
/**
 * BotanicalFamilyController implements the CRUD actions for BotanicalFamily model.
 */
class BotanicalFamilyController extends Controller
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
     * Lists all BotanicalFamily models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BotanicalFamilySearch();
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
     * Displays a single BotanicalFamily model.
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
     * Creates a new BotanicalFamily model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BotanicalFamily();

        if ($model->load(Yii::$app->request->post())) {
          if ($model->save()){
            Yii::$app->session->setFlash('success', 'Familia botánica creada correctamente.');
            return $this->redirect(['index']);
          }else{
            Yii::$app->session->setFlash('error', 'Ocurrió un error al crear la familia botánica.');
          }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BotanicalFamily model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          if ($model->save()){
            Yii::$app->session->setFlash('success', 'Familia botánica actualizada correctamente.');
            return $this->redirect(['index']);
          }else{
            Yii::$app->session->setFlash('error', 'Ocurrió un error al actualizar la familia botánica.');
          }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BotanicalFamily model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      if (count($model->plants) == 0){
        $model->delete();
        Yii::$app->session->setFlash('success', 'Familia botánica eleminada correctamente.');
      }else{
        Yii::$app->session->setFlash('error', 'Ocurrió un error al eliminar la familia botánica.');
      }

      return $this->redirect(['index']);
    }

    /**
     * Finds the BotanicalFamily model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BotanicalFamily the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BotanicalFamily::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
