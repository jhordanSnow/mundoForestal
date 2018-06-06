<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use backend\models\User;
use frontend\models\SignupForm;
use backend\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\UserSearch;
use yii\data\ActiveDataProvider;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->innerJoinWith('admin', 'admin.IdUsuario = admin.id')->where(['<>','id',Yii::$app->user->identity->id]);
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
     * Displays a single Admin model.
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
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $model = new SignupForm();
      if ($model->load(Yii::$app->request->post())) {
        $commit = true;
        $transaction = Yii::$app->db->beginTransaction();
        if ($user = $model->signup()) {
          $modelAdmin = new Admin();
          $modelAdmin->IdUsuario = $user->id;
          if (!$modelAdmin->save()){
            $commit = false;
          }
        }else{
          $commit = false;
        }
        if ($commit){
          $transaction->commit();
          Yii::$app->session->setFlash('success', 'Administrador creado correctamente.');
          return $this->redirect(['index']);
        }else{
          $transaction->rollback();
          Yii::$app->session->setFlash('success', 'Ocurrio un error al crear el administrador.');
        }
      }

      return $this->render('create', [
          'model' => $model,
      ]);
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdUsuario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      $commit = false;
      $transaction = Yii::$app->db->beginTransaction();
      if (count($model->answers) == 0){
        if ($model->delete() && User::find()->where(['id' =>$id])->one()->delete()){
          $commit = true;
        }
    }
    if ($commit){
      $transaction->commit();
      Yii::$app->session->setFlash('success', 'Adminstrador eleminado correctamente.');
    }else{
      $transaction->rollback();
      Yii::$app->session->setFlash('error', 'Ocurrió un error al eliminar el administrador.');
    }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
