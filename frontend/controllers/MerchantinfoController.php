<?php

namespace frontend\controllers;

use Yii;
use common\models\MerchantInfo;
use common\models\service\MerchantinfoService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\model\Categorymode;
use common\models\Category;

/**
 * MerchantinfoController implements the CRUD actions for Merchantinfo model.
 */
class MerchantInfoController extends Controller
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
     * Lists all Merchantinfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MerchantinfoService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Merchantinfo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Merchantinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity) {
            $model = new MerchantInfo();
            $MerchantinfoService = new MerchantInfoService();
            $model->member_id = Yii::$app->user->id;
            $models = MerchantInfo::find()->where(['member_id' => Yii::$app->user->id])->asArray()->all();
            if(!empty($models)){
                return $this->render('enterprise');
            }
            $model->group_id = 1;
            if ($model->load(Yii::$app->request->post())) {
                $images = $MerchantinfoService->uploads($model,array('1'=>'principal_idcard_img','2'=>'principal_idcard_img2','3'=>'business_license_img'),$img = 'images/');
                $model->principal_idcard_img = $images['0'];
                $model->principal_idcard_img2 = $images['1'];
                $model->business_license_img = $images['2'];

                if ($model->save()) {
                    echo "<script>alert('上传成功')</script>";
                    return $this->redirect(['merchant-info/audit']);
                } else {
                    echo "<script>alert('提交失败')</script>";
//                    return $this->error(‘数据修改失败！’);
                    return $this->render('create');
                }
            } else {
                $cat=new Categorymode('',array('id','pid','category_name','fullname'));
                $_list=$cat->getTree(Category::get_menus(true));//获取分类结构
                foreach($_list as $value){
                    $list[$value['id']] = $value['fullname'];
                }
                return $this->render('create', [
                    'model' => $model,
                    'list' => $list,
                ]);
            }
        } else {
            return  "<script language='javascript'>
                        alert('请先登录');
                    if(confirm('你确定要去登录页面')){
                        location.href='http://huahangxq.com/index.php?r=member/login';
                      }else{
                        location.href = 'http://huahangxq.com/index.php?r=site/index';
                      }
                    </script>";

//            Yii::$app->getSession()->setFlash('success', '请先登录 亲');
//            return $this->redirect(array('/member/login'));
        }
    }

    /**
     * Updates an existing Merchantinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('frontendupdate');
        $principal_idcard_img = $model->principal_idcard_img;
        $principal_idcard_img2 = $model->principal_idcard_img2;
        $business_license_img = $model->business_license_img;
        $MerchantInfoService = new MerchantInfoService();
        if ($model->load(Yii::$app->request->post())) {
            $upload = UploadedFile::getInstance($model, 'principal_idcard_img');
            if(empty($upload)){

                $model->principal_idcard_img = $principal_idcard_img;
                $model->principal_idcard_img2 = $principal_idcard_img2;
                $model->business_license_img = $business_license_img;

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
                $images = $MerchantInfoService->uploads($model,array('1'=>'principal_idcard_img','2'=>'principal_idcard_img2','3'=>'business_license_img'));
                $model->principal_idcard_img = $images['0'];
                $model->principal_idcard_img2 = $images['1'];
                $model->business_license_img = $images['2'];
            }
            $model->audit_state = 1;
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', '提交成功');
                return $this->redirect(['merchant-info/audit']);
            }else{
            }
        } else {
                $model -> principal_idcard_img = "";
                $model -> principal_idcard_img2 = "";
                $model -> business_license_img = "";
            $cat=new Categorymode('',array('id','pid','category_name','fullname'));
            $_list=$cat->getTree(Category::get_menus(true));//获取分类结构
            foreach($_list as $value){
                $list[$value['id']] = $value['fullname'];
            }
            return $this->render('update', [
                'model' => $model,
                'list' => $list,
            ]);
        }
    }


    /**
     * Deletes an existing Merchantinfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(file_exists($model->principal_idcard_img) && file_exists($model->principal_idcard_img2) && file_exists($model->business_license_img)){
           unlink($model->principal_idcard_img);
           unlink($model->principal_idcard_img2);
           unlink($model->business_license_img);
        }else{
            echo "<script>alert('文件夹缺少图片来源,请检查'),history.back(-1);</script>";
            exit;
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Merchantinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Merchantinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Merchantinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    //审核状态页面
    public function actionAudit(){
        $id  =  Yii::$app->user->id;
        $model = MerchantInfo::find()->where(['member_id' => $id])->asArray()->all();
        if(isset($model)){
            return $this->render('audit',[
                'data' =>$model[0]['audit_state'],
            ]);
        }else{
            echo "不为人知的错误请返回重新操作";
        }


    }


    //审核通过 商家链接
    public function  actionEnterprise()
    {

        return $this->render('enterprise');
    }
}
