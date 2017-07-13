<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Base controller
 */
class BaseController extends Controller {

    public $myapp = 1;

    /**
     * 基控制器初始化
     */
    public function init() {
        //echo "OK!";
        $this->myapp = "OK!";
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [];
    }

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $permissionName = '/'.$controller . '/' . $action;
        if (!\Yii::$app->user->can($permissionName) && Yii::$app->getErrorHandler()->exception === null) {
            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function test() {
        return "大小写区分测试！";
    }

}
