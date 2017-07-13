<?php
namespace frontend\controllers;


use common\models\EnterpriseUser;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\EnterpriseForm;
use frontend\models\EnterpriseSignupFrom;
use frontend\models\EnterpriseSignupUpdate;
use common\models\model\Enterprisemodel;
use yii\web\UploadedFile;
use common\models\Category;
use frontend\models\EnterprisePasswordForm;

/**
 * member controller
 */
class EnterpriseController extends Controller
{


    public function actionIndex()
    {


        return $this->render('index');
    }

   // 用户注册
    public function actionSignup(){
        $model = new EnterpriseSignupFrom();
        $Enterprisemodel = new Enterprisemodel();
        if($model->load(Yii::$app->request->post())){
            $images = $Enterprisemodel->uploads($model,array('1'=>'principal_idcard_img','2'=>'principal_idcard_img2','3'=>'business_license_img'),$img = 'enterprise/');
            $model->principal_idcard_img = $images['0'];
            $model->principal_idcard_img2 = $images['1'];
            $model->business_license_img = $images['2'];
            $model->account = rand();
            $model->level_id = 10;
            $model->status2 = 2;
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
        $model = new EnterpriseForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()  ) {
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

    //入驻更新
    public function actionUpdateuser($id){
        $model = $this->findModel($id);
        $principal_idcard_img =  $model->principal_idcard_img;
        $principal_idcard_img2 =  $model->principal_idcard_img2;
        $business_license_img =  $model->business_license_img;

        if($model->load(Yii::$app->request->post())){
            if($model->principal_idcard_img == null){
                $upload = UploadedFile::getInstance($model, 'principal_idcard_img');
                if(empty($upload)){

                }else{
                    $path = Yii::getAlias('@frontend/web/');
                    $models = $this->findModel($id);

                    if(file_exists($path.$models->principal_idcard_img)
                        && file_exists($path.$models->principal_idcard_img2)
                        && file_exists($path.$models->business_license_img)){
                        unlink($models->principal_idcard_img);
                        unlink($models->principal_idcard_img2);
                        unlink($models->business_license_img);
                    }else{
                        echo "<script>alert('文件夹缺少图片来源,请检查'),history.back(-1);</script>";
                        exit;
                    }
                        $Enterprisemodel = new Enterprisemodel();
                    $images = $Enterprisemodel->uploads($model,array('1'=>'principal_idcard_img','2'=>'principal_idcard_img2','3'=>'business_license_img'),$img = 'enterprise/');
                    $model->principal_idcard_img = $images['0'];
                    $model->principal_idcard_img2 = $images['1'];
                    $model->business_license_img = $images['2'];
                    $model->status2 = 2;
                    if($model->save()){
                        Yii::$app->getSession()->setFlash('success', '更新成功');
                        return $this->redirect('index');
                    }else{
                        Yii::$app->getSession()->setFlash('success', '更新失败请重新提交');
                        return $this->render('updateuser',[
                            'model' => $this->findModel($id),
                        ]);
                    }
                }

            }else{
                Yii::$app->getSession()->setFlash('success', '系统出错 请联系管理员');
                exit;
            }
            echo "<pre>";
            print_r($model->principal_idcard_img);die;
        }

        $model->principal_idcard_img  = "";
        $model->principal_idcard_img2  = "";
        $model->business_license_img  = "";
        return $this->render('updateuser',[
            'model'=>$model,
        ]);
    }

    //审核页面
    public  function actionAudit(){
        if(!Yii::$app->user->identity){

            Yii::$app->getSession()->setFlash('success', '请先登录');
            return $this->redirect('?r=enterprise/login');
        }

        $status = Enterprisemodel::audit_state($userid = Yii::$app->user->id,$b = 1);
        if($status == "<a href='/index.php?=enterprise/index'>审核通过</a>"){
            Yii::$app->getSession()->setFlash('success', '恭喜您审核已通过 请放心使用孔雀王');
            return $this->redirect('?r=enterprise/personal');
        }elseif($status == "审核中"){
            Yii::$app->getSession()->setFlash('success', '审核中请等候1-3个工作日');
            $status = "<h2 style='color: red;'>$status </h2>";
        }
        return  $this->render('audit',[
            'status'=>$status,
            'succes' => '<script lang="javascript">setTimeout(function() {$("#w2-success-0").slideUp(500);}, 3000);</script>',
        ]);
    }

    public function actionPersonal(){
        if(!Yii::$app->user->identity){
            return $this->redirect(['enterprise/login']);
        }else{
            $enterprise = Yii::$app->user->id;
//            $enterprise = 47;
            $enterprise_user_extend = Yii::$app->db->createCommand("select * from hhqy_enterprise_user_extend where enterprise_id = $enterprise")->queryOne();
           if($enterprise_user_extend == !true){
               Yii::$app->getSession()->setFlash('success', '请完善行业分类信息方便你今后的操作');
               $category_top =  Category::find()->asArray()->all();
                $enterprisemodel =  new Enterprisemodel();

               $category_id = $enterprisemodel->make_tree($category_top,$pk='id',$pid='pid',$child='_child',$root=0);

               return $this->render('category_user',[
                   'category_id' =>$category_id
               ]);

           }
            return $this->render('personal');
        }
    }

    //ajax 获取展现分类
    public function actionAjaxs(){
        $enterprisemodel =  new Enterprisemodel();
        if(!empty($_GET['id'])){
            $category_top = $enterprisemodel->lists($_GET['id']);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'pach' => $category_top,
                'code' => 100,
            ];
        }else{
            Yii::$app->getSession()->setFlash('success', '参数丢失请重新操作');
            return $this->render('personal');
        }
    }

    //插入商家分类
    public function actionList(){
        $array = array();
        foreach ($_GET['arr'] as $key=>$vo){

            $array =   $this->getParents($vo);
            $connection = Yii::$app->db;
            $connection->createCommand()->insert('hhqy_enterprise_user_extend', [
                'enterprise_id' =>  Yii::$app->user->id,
                'category_id_1' => $array[2],
                'category_id_2' => $array[1],
                'category_id_3' => $array[0],
                'category_id_4' => "",
                'category_id_5' => "",
                'category_id_6' => "",
                'province_id' => 1,
                'city_id' => 1,
                'area_id' => 2,
                'star_level' => 1,
                'sort' => 1,
                'created_at' => 312123,
                'updated_at' => 312123,
            ])->execute();

        }

        Yii::$app->getSession()->setFlash('success', '分类成功 请放心使用此平台');
        return $this->redirect('?r=enterprise/index');


    }
    function getParents($id){
        $subid=[];
        while ($id!=0) {
            $pidarray= Category::find()->where(['id'=>$id])->asArray()->one();
            $subid[]=$pidarray["id"];
            $id=$pidarray["pid"];
        }
        return $subid;
    }

    //修改密码
    public  function actionEnterprise_password_form(){
        $model = new EnterprisePasswordForm();
        $userpassword=  EnterpriseUser::findIdentity(YII::$app->user->id);
        $password = $userpassword->password_hash;
        if($model->load(Yii::$app->request->post())){
            if(Yii::$app->getSecurity()->validatePassword($model->password_hash, $password)){
                    if($model->password ==$model->reppassword){
                        $newPass = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                        $userpassword->password_hash = $newPass;
                        if($userpassword->save()){
                            Yii::$app->user->logout();
                            return $this->redirect('?r=enterprise/login');
                        }else{
                            Yii::$app->getSession()->setFlash('success', '不为人知的错误请重新提交');
                            return $this->redirect('?r=enterprise/enterprise_password_form');
                        }
                    }else{
                        Yii::$app->session->setFlash('contact','两次新密码不相等');
                        return false;
                    }
            }else{
                Yii::$app->getSession()->setFlash('success', '旧密码错误');
                return $this->redirect('?r=enterprise/enterprise_password_form');
            }

        }else{
            return $this->render('enterprise_password_form', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = EnterpriseSignupUpdate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
