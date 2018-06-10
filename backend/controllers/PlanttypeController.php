<?php

namespace backend\controllers;

use Yii;
use backend\models\Planttype;
use backend\models\PlanttypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;

/**
 * PlanttypeController implements the CRUD actions for Planttype model.
 */
class PlanttypeController extends Controller
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
     * Lists all Planttype models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanttypeSearch();
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
     * Displays a single Planttype model.
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
     * Creates a new Planttype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Planttype();

        if ($model->load(Yii::$app->request->post())) {
          if ($model->save()){
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['success' => true, 'IdType' => $model->IdType, 'Name' => $model->Name];
            }
            Yii::$app->session->setFlash('success', 'Tipo de planta creado correctamente.');
            return $this->redirect(['index']);
          }else{
            Yii::$app->session->setFlash('error', 'Ocurrió un error al crear el tipo de planta.');
          }
        }

        if (Yii::$app->request->isAjax) {
          return $this->renderAjax('_form', [
                'model' => $model,
          ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Planttype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          if ($model->save()){
            Yii::$app->session->setFlash('success', 'Tipo de planta actualizado correctamente.');
            return $this->redirect(['index']);
          }else{
            Yii::$app->session->setFlash('error', 'Ocurrió un error al actualizar el tipo de planta.');
          }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Planttype model.
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
        Yii::$app->session->setFlash('success', 'Tipo de planta eleminado correctamente.');
      }else{
        Yii::$app->session->setFlash('error', 'Ocurrió un error al eliminar el tipo de planta.');
      }

      return $this->redirect(['index']);
    }

    /**
     * Finds the Planttype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Planttype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Planttype::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
