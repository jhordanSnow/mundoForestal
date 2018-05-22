<?php

namespace backend\controllers;

use Yii;
use backend\models\PlantCharacteristic;
use backend\models\PlantCharacteristicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlantCharacteristicController implements the CRUD actions for PlantCharacteristic model.
 */
class PlantCharacteristicController extends Controller
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
     * Lists all PlantCharacteristic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlantCharacteristicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlantCharacteristic model.
     * @param integer $IdPlant
     * @param integer $IdCharacteristic
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($IdPlant, $IdCharacteristic)
    {
        return $this->render('view', [
            'model' => $this->findModel($IdPlant, $IdCharacteristic),
        ]);
    }

    /**
     * Creates a new PlantCharacteristic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlantCharacteristic();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IdPlant' => $model->IdPlant, 'IdCharacteristic' => $model->IdCharacteristic]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PlantCharacteristic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $IdPlant
     * @param integer $IdCharacteristic
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($IdPlant, $IdCharacteristic)
    {
        $model = $this->findModel($IdPlant, $IdCharacteristic);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IdPlant' => $model->IdPlant, 'IdCharacteristic' => $model->IdCharacteristic]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PlantCharacteristic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $IdPlant
     * @param integer $IdCharacteristic
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($IdPlant, $IdCharacteristic)
    {
        $this->findModel($IdPlant, $IdCharacteristic)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PlantCharacteristic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $IdPlant
     * @param integer $IdCharacteristic
     * @return PlantCharacteristic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IdPlant, $IdCharacteristic)
    {
        if (($model = PlantCharacteristic::findOne(['IdPlant' => $IdPlant, 'IdCharacteristic' => $IdCharacteristic])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
