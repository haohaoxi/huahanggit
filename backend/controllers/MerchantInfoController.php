<?php

namespace backend\controllers;

use Yii;
use common\models\MerchantInfo;
use common\models\service\MerchantInfoService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\model\Categorymode;
use common\models\Category;


/**
 * MerchantInfoController implements the CRUD actions for MerchantInfo model.
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
     * Lists all MerchantInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MerchantInfoService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MerchantInfo model.
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
     * Creates a new MerchantInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity) {
            $model = new MerchantInfo();
            $MerchantInfoService = new MerchantInfoService();
            $model->member_id = Yii::$app->user->id;
            if ($model->load(Yii::$app->request->post())) {

                $images = $MerchantInfoService->uploads($model,array('1'=>'principal_idcard_img','2'=>'principal_idcard_img2','3'=>'business_license_img'),$img = 'images/');

                $model->principal_idcard_img = $images['0'];
                $model->principal_idcard_img2 = $images['1'];
                $model->business_license_img = $images['2'];
                if ($model->save()) {
                    return $this->redirect(['index']);
                } else {
                    echo "<script>alert('提交失败')</script>";
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            echo "未登录 请跳转登录页面登录";
            die;
        }
    }

    /**
     * Updates an existing MerchantInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('backendupdate');
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
                    unlink($path.$models->principal_idcard_img);
                    unlink($path.$models->principal_idcard_img2);
                    unlink($path.$models->business_license_img);
                }else{
                    echo "<script>alert('文件夹缺少图片来源,请检查delete'),history.back(-1);</script>";
                    exit;
                }
                $images = $MerchantInfoService->uploads($model,array('1'=>'principal_idcard_img','2'=>'principal_idcard_img2','3'=>'business_license_img'),$img = 'images/');
                $model->principal_idcard_img = $images['0'];
                $model->principal_idcard_img2 = $images['1'];
                $model->business_license_img = $images['2'];
            }
            if($model->save()){
                return $this->redirect(['index']);
            }else{

            }
        } else {
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
     * Deletes an existing MerchantInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $path = Yii::getAlias('@frontend/web/');
//        $path  =  dirname(dirname(dirname(__FILE__))).'/frontend/web/';
        $model = $this->findModel($id);
        if(file_exists($path.$model->principal_idcard_img)
            && file_exists($path.$model->principal_idcard_img2)
            && file_exists($path.$model->business_license_img)){
            unlink($path.$model->principal_idcard_img);
            unlink($path.$model->principal_idcard_img2);
            unlink($path.$model->business_license_img);

        }else{
            echo "<script>alert('文件夹缺少图片来源,请检查'),history.back(-1);</script>";
            exit;
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the MerchantInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MerchantInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MerchantInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
