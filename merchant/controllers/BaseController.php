<?php

namespace merchant\controllers;

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
        return [
		       'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x000000, //背景颜色
                'maxLength' => 6, //最大显示个数
                'minLength' => 5, //最少显示个数
                'padding' => 5, //间距
                'height' => 40, //高度
                'width' => 130, //宽度  
                'foreColor' => 0xffffff, //字体颜色
                'offset' => 4, //设置字符偏移量 有效果
            //'controller'=>'login',        //拥有这个动作的controller
            //      echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'login/captcha',
            //      'imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer;margin-left:25px;'],'template'=>'{image}']);
//我这里写的跟官方的不一样，因为我这里加了一个参数(login/captcha),这个参数指向你当前控制器名，
//如果不加这句，就会找到默认的site控制器上去，验证码会一直出不来，在style里是可以写css代码的，可以调试样式 
            ],];
    }

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $permissionName = '/'.$controller . '/' . $action;
     //   if (!\Yii::$app->user->can($permissionName) && Yii::$app->getErrorHandler()->exception === null) {
      //      throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
     //   }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function test() {
        return "大小写区分测试！";
    }

}
