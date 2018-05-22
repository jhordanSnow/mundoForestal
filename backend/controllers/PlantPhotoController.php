<?php

namespace backend\controllers;

use Yii;
use backend\models\PlantPhoto;
use backend\models\PlantPhotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlantPhotoController implements the CRUD actions for PlantPhoto model.
 */
class PlantPhotoController extends Controller
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
     * Lists all PlantPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlantPhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlantPhoto model.
     * @param integer $IdPlant
     * @param integer $IdPhoto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($IdPlant, $IdPhoto)
    {
        return $this->render('view', [
            'model' => $this->findModel($IdPlant, $IdPhoto),
        ]);
    }

    /**
     * Creates a new PlantPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlantPhoto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IdPlant' => $model->IdPlant, 'IdPhoto' => $model->IdPhoto]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PlantPhoto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $IdPlant
     * @param integer $IdPhoto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($IdPlant, $IdPhoto)
    {
        $model = $this->findModel($IdPlant, $IdPhoto);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IdPlant' => $model->IdPlant, 'IdPhoto' => $model->IdPhoto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PlantPhoto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $IdPlant
     * @param integer $IdPhoto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($IdPlant, $IdPhoto)
    {
        $this->findModel($IdPlant, $IdPhoto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PlantPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $IdPlant
     * @param integer $IdPhoto
     * @return PlantPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IdPlant, $IdPhoto)
    {
        if (($model = PlantPhoto::findOne(['IdPlant' => $IdPlant, 'IdPhoto' => $IdPhoto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
