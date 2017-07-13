<?php

namespace backend\controllers;

use common\models\EnterpriseUser;
use Yii;
use common\models\EnterpriseUserAdmin;
use common\models\service\EnterpriseUserAdminService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnterpriseUserController implements the CRUD actions for EnterpriseUserAdmin model.
 */
class EnterpriseUserController extends Controller
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
     * Lists all EnterpriseUserAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnterpriseUserAdminService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnterpriseUserAdmin model.
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
     * Creates a new EnterpriseUserAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EnterpriseUserAdmin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EnterpriseUserAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $principal_idcard_img = $model->principal_idcard_img;
        $principal_idcard_img2 = $model->principal_idcard_img2;
        $business_license_img = $model->business_license_img;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'principal_idcard_img' =>$principal_idcard_img,
                'principal_idcard_img2' =>$principal_idcard_img2,
                'business_license_img' =>$business_license_img,
            ]);
        }
    }

    /**
     * Deletes an existing EnterpriseUserAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {       $path = Yii::getAlias('@frontend/web/');
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
     * Finds the EnterpriseUserAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EnterpriseUserAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EnterpriseUserAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    //开启用户和关闭用户
    public  function actionStatus($id){
     $enterprise = EnterpriseUserAdmin::find(['status'])->where(['id'=>$id])->one();
    if($enterprise->status == 1){
        $enterprise->status = 2;
        $enterprise->save();
        return $this->redirect('?r=enterprise-user/index');
    }else{
        $enterprise->status =1;
        $enterprise->save();
        return $this->redirect('?r=enterprise-user/index');
    }
    }

    //审核通过 和未通过
    public function actionStatus2($id){
        $enterprise = EnterpriseUserAdmin::find(['status2'])->where(['id'=>$id])->one();
        if($enterprise->status2 == 2){
            $enterprise->status2 = 1;
            $enterprise->save();
            return $this->redirect('?r=enterprise-user/index');
        }else{
            $enterprise->status2 = 1;
            $enterprise->save();
            return $this->redirect('?r=enterprise-user/index');
        }
    }

    //认证状态的审核中和未通过
    public  function actionStatus22($id){
        $enterprise  = EnterpriseUserAdmin::find(['status2'])->where(['id'=>$id])->one();
        if($enterprise->status2 ==2){
            $enterprise->status2 =3;
            $enterprise->save();
            return $this->redirect('?r=enterprise-user/index');
        }else if($enterprise->status2 ==1){
            $enterprise->status2 =3;
            $enterprise->save();
            return $this->redirect('?r=enterprise-user/index');
        }else{
            $enterprise->status2 = 2;
            $enterprise->save();
            return $this->redirect('?r=enterprise-user/index');
        }
    }
}
