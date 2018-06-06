<?php

namespace backend\controllers;

use Yii;
use backend\models\Terminology;
use backend\models\TerminologySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * TerminologyController implements the CRUD actions for Terminology model.
 */
class TerminologyController extends Controller
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
     * Lists all Terminology models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TerminologySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider = new ActiveDataProvider([
            'query' => $dataProvider->query,
            'pagination' => [ 'pageSize' => 5 ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Terminology model.
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
     * Creates a new Terminology model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Terminology();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
          if ($model->upload()) {
            Yii::$app->session->setFlash('success', 'Término creado correctamente.');
            return $this->redirect(['index']);
          }else{
            Yii::$app->session->setFlash('error', 'Ocurrio un error al crear el término.');
          }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Terminology model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
          if ($model->upload()) {
            Yii::$app->session->setFlash('success', 'Término actualizado correctamente.');
            return $this->redirect(['index']);
          }else{
            Yii::$app->session->setFlash('error', 'Ocurrio un error al actualizar el término.');
          }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Terminology model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      $photo = $model->Photo;
      if ($model->delete()){
        if ($photo != null){
          unlink(Yii::getAlias('@backend'). '/web/Images/'.$photo);
        }
        Yii::$app->session->setFlash('success', 'Término eleminado correctamente.');
      }else{
        Yii::$app->session->setFlash('error', 'Ocurrió un error al eliminar el término.');
      }

      return $this->redirect(['index']);
    }

    /**
     * Finds the Terminology model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Terminology the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Terminology::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
