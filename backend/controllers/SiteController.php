<?php

namespace backend\controllers;

use Yii;
//use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use backend\controllers\BaseControllerController;
use common\models\LoginForm;
use backend\models\form\Login;
use common\models\RegisterForm;

/**
 * Site controller
 */
class SiteController extends BaseController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'register', 'error', 'index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [ 'index','logout', 'error',],
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
//    public function actions() {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {

        // $message=$this->myapp;
        //$message=SiteController::className();
        //$message=\backend\controllers\SiteController::CLASS;
        $message = $this->Test();
        return $this->render('index', ['message' => $message]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionRegister() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();


        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goHome();
        } else {
            return $this->render('register', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function handleError($code, $message, $file, $line) {
        if (error_reporting() & $code) {
            // load ErrorException manually here because autoloading them will not work  
            // when error occurs while autoloading a class  
            if (!class_exists('yii\\base\\ErrorException', false)) {
                require_once(__DIR__ . '/ErrorException.php');
            }
            $exception = new ErrorException($message, $code, $code, $file, $line);

            // in case error appeared in __toString method we can't throw any exception  
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS); //得到调用栈数组  
            array_shift($trace);
            foreach ($trace as $frame) {
                if ($frame['function'] === '__toString') {
                    $this->handleException($exception);
                    if (defined('HHVM_VERSION')) {
                        flush();
                    }
                    exit(1);
                }
            }

            throw $exception;
        }
        return false;
    }

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

}
