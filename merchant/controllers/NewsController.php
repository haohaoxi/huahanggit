<?php
namespace merchant\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use merchant\controllers\BaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use common\models\NewsForm;

/**
 * Site controller
 */
class NewsController extends BaseController
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
     /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionDetails()
    {
        return $this->render('Details');
    }   
     /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }  
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionEdit()
    {
       // var_dump(Yii::$app);exit;
        return $this->render('Edit');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAdd()
    {
        return $this->render('Add');
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionDel()
    {
        return $this->render('Del');
    }

}
