<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\MemberForm;
use frontend\models\MemberSigunpFrom;
/**
 * member controller
 */
class MemberController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }

   // 用户注册
    public function actionSignup(){
        $model = new MemberSigunpFrom();
       $model->level_id = 5;
        if($model->load(Yii::$app->request->post())){
            if($user = $model->signup()){
                if (Yii::$app->getUser()->login($user)) {

                   return $this->goHome();
                }
            }
        }
        return $this->render('signup',[
            'model'=>$model
        ]);
    }


// 用户登录
    public function actionLogin(){
        $model = new MemberForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    //用户退出登录
    public function actionLogout(){
      Yii::$app->user->logout();
        return $this->render('index');
    }
}
