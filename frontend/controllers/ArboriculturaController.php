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
use backend\models\Planttype;
use backend\models\Botanicalfamily;

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

    public function actionArboricultor(){
      return $this->render('arboricultor');
    }

    public function actionQuestions(){
      return $this->render('questions');
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
      $pages = new Pagination(['totalCount' => $plants->count(), 'pageSize' => 10]);
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
}
