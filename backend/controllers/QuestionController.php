<?php

namespace backend\controllers;

use Yii;
use backend\models\Question;
use backend\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


use backend\models\Answer;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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

    public function actionAnswer($id)
    {
      $model = $this->findModel($id);
      $modelAnswer = Answer::find()->where(['IdQuestion' => $id])->one();
      $modelAnswer->IdAdmin = Yii::$app->user->identity->id;
      $modelAnswer->IdQuestion = $id;

      if (Yii::$app->request->isPost && $modelAnswer->load(Yii::$app->request->post())) {
            $modelAnswer->imageFile = UploadedFile::getInstance($modelAnswer, 'imageFile');
            if ($modelAnswer->upload()) {
              Yii::$app->session->setFlash('success', 'Respuesta guardada correctamente, la pregunta será publicada en el portal.');
              return $this->redirect(['question/index']);
            }else{
              Yii::$app->session->setFlash('error', 'Hubo un error al guardar la respuesta.');
            }
        }

      return $this->render('answer', [
          'model' => $model,
          'modelAnswer' => $modelAnswer,
      ]);
    }

    public function actionActivate($id)
    {
        $model = $this->findModel($id);
        $model->state = 1;
        if ($model->save()){
          Yii::$app->session->setFlash('success', 'La consulta se ha publicado correctamente.');
        }else{
          Yii::$app->session->setFlash('error', 'Hubo un error al publicar la consulta.');
        }

        return $this->redirect(['question/index']);
    }

    public function actionDeactivate($id)
    {
        $model = $this->findModel($id);
        $model->state = 0;
        if ($model->save()){
          Yii::$app->session->setFlash('success', 'La consulta se ha ocultado correctamente.');
        }else{
          Yii::$app->session->setFlash('error', 'Hubo un error al ocultar la consulta.');
        }

        return $this->redirect(['question/index']);
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Question();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdQuestion]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdQuestion]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Question model.
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
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
