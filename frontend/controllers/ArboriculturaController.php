<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use backend\models\Plant;
use backend\models\Question;
use backend\models\Terminology;
use backend\models\QuestionCategory;
use backend\models\Planttype;
use backend\models\Botanicalfamily;
use backend\models\Pagedata;

use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class ArboriculturaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
              ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionMap($id){
      $Plant = Plant::find()->where(['IdPlant' => $id])->one();

      return $this->renderAjax('_map',[
        'Plant' => $Plant,
      ]);
    }

    public function actionArboricultor(){
      return $this->render('arboricultor');
    }

    public function actionTerminologia(){
      $terms = Terminology::find();
      $terms->andFilterWhere([
          'and',
          ['=', 'IdTerminology', Yii::$app->getRequest()->getQueryParam('IdTerminology')],
      ]);
      $countQuery = clone $terms;
      $pages = new Pagination(['totalCount' => $terms->count(), 'pageSize' => 3]);
      $models = $terms->offset($pages->offset)->limit($pages->limit)->all();

      $termList = ArrayHelper::map(Terminology::find()->all(),'IdTerminology', 'Term');

      return $this->render('terminology',[
        'pages' => $pages,
        'terms' => $models,
        'termList' => $termList,
      ]);
    }

    public function actionQuestions(){

      $questions = Question::find()->where(['state' => 1]);
      $questions->andFilterWhere([
          'and',
          ['like', 'IdCategory', Yii::$app->getRequest()->getQueryParam('IdCategory')],
      ]);
      $countQuery = clone $questions;
      $pages = new Pagination(['totalCount' => $questions->count(), 'pageSize' => 10]);
      $models = $questions->offset($pages->offset)->limit($pages->limit)->all();

      $categoryList = ArrayHelper::map(QuestionCategory::find()->all(),'IdCategory', 'Name');

      return $this->render('questions',[
        'pages' => $pages,
        'questions' => $models,
        'categoryList' => $categoryList,
      ]);
    }

    public function actionSearchPlant(){

      $plants = Plant::find();
      $plants->andFilterWhere([
          'and',
          ['like', 'Name', Yii::$app->getRequest()->getQueryParam('Name')],
          ['like', 'ScientificName', Yii::$app->getRequest()->getQueryParam('ScientificName')],
          ['like', 'IdFamily', Yii::$app->getRequest()->getQueryParam('IdFamily')],
          ['like', 'IdType', Yii::$app->getRequest()->getQueryParam('IdType')],
      ]);
      $countQuery = clone $plants;
      $pages = new Pagination(['totalCount' => $plants->count(), 'pageSize' => 5]);
      $models = $plants->offset($pages->offset)->limit($pages->limit)->all();

      $familyList = ArrayHelper::map(Botanicalfamily::find()->all(),'IdFamily', 'Name');
      $typeList = ArrayHelper::map(Planttype::find()->all(),'IdType', 'Name');

      return $this->render('searchPlant',[
        'pages' => $pages,
        'plants' => $models,
        'typeList' => $typeList,
        'familyList' => $familyList,
      ]);
    }

    public function actionContent($id)
    {
      $model = Pagedata::find()->where(['IdData' => $id])->one();
      return $this->render('content',[
        'model' => $model,
      ]);
    }
}
