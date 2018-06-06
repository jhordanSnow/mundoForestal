<?php

namespace backend\controllers;

use Yii;
use backend\models\QuestionCategory;
use backend\models\QuestionCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * QuestionCategoryController implements the CRUD actions for QuestionCategory model.
 */
class QuestionCategoryController extends Controller
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
     * Lists all QuestionCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionCategorySearch();
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
     * Displays a single QuestionCategory model.
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
     * Creates a new QuestionCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuestionCategory();

        if ($model->load(Yii::$app->request->post())) {
          if ($model->save()){
              Yii::$app->session->setFlash('success', 'Categoría creada correctamente.');
              return $this->redirect(['question-category/index']);
          }else{
            Yii::$app->session->setFlash('error', 'Ocurrió un error al crear la categoría.');
          }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing QuestionCategory model.
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
            Yii::$app->session->setFlash('success', 'Categoría actualizada correctamente.');
            return $this->redirect(['question-category/index']);
        }else{
          Yii::$app->session->setFlash('error', 'Ocurrió un error al actualizar la categoría.');
        }
      }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing QuestionCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      if (count($model->questions) == 0){
        $model->delete();
        Yii::$app->session->setFlash('success', 'Categoría eleminada correctamente.');
      }else{
        Yii::$app->session->setFlash('error', 'Ocurrió un error al eliminar la categoría.');
      }

        return $this->redirect(['index']);
    }

    /**
     * Finds the QuestionCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
