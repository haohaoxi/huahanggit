<<<<<<< .mine
<?php

namespace backend\controllers;

use Yii;
use common\models\Region;
use common\models\service\RegionService;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends BaseController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex() {
     //   $mail = Yii::$app->mailer->compose();
     //   $mail->setTo('2562611287@qq.com'); //要发送给那个人的邮箱 
    ///    $mail->setSubject("邮件主题"); //邮件主题 
    //    $mail->setTextBody('测试text'); //发布纯文字文本 
     //   $mail->setHtmlBody("测试html text"); //发送的消息内容 
     //   var_dump($mail->send());
      //  exit;

        $searchModel = new RegionService();
        //检查session是否打开

//        if (!Yii::$app->session->isActive) {
//            Yii::$app->session->open();
//        } else {
//            echo "有session";
//            Yii::$app->session->set('login_sms_time', time());
//            print_r(Yii::$app->session);
//            print_r($_SESSION);
//        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $regionTree=$searchModel->getRegionTree();
        //  $regionChilds=Region::find()->select(["code","parentCode"])->asArray()->all();
        // $regionChilds= $searchModel->getchilds(110100);
      //  $test = Region::find()->where('code=:code', array(':code' => 110100))->asArray()->all();
      //  print_r($test);
       // exit;
        //  print_r($regionChilds);        print_r($regionTree);EXIT;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 短信接口
     */
    public function smsSend() {
        include "TopSdk.php";
        date_default_timezone_set('Asia/Shanghai');
//{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
        $c = new TopClient;
        $c->appkey = '24445262';
        $c->secretKey = 'c4d253919f59ce113a4e235a41c52e9f';
        // $req = new TradeVoucherUploadRequest;
        // $req->setFileName("example");
        // $req->setFileData("@/Users/xt/Downloads/1.jpg");
        // $req->setSellerNick("奥利奥官方旗舰店");
        // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
        // var_dump($c->execute($req));

        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsTemplateCode('SMS_71371004');
        $req->setRecNum('18168736275');
        $smsParams = ["number" => 123];
        $req->setSmsParam(json_encode($smsParams));
        $req->setSmsFreeSignName('寰宇科技');
        $req->setSmsType('normal');
        $req->setExtend('demo');
        var_dump($c->execute($req));
    }

    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * ajax 添加地区信息
     */
    public function actionAdd() {
       // Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Region();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
               return $this->renderAjax('add',['data'=>$model->code]);
            }
        } else {

            return $this->render('add', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Region();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Region model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Region model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
||||||| .r155
<?php

namespace backend\controllers;

use Yii;
use common\models\Region;
use common\models\service\RegionService;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends BaseController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex() {
     //   $mail = Yii::$app->mailer->compose();
     //   $mail->setTo('2562611287@qq.com'); //要发送给那个人的邮箱 
    ///    $mail->setSubject("邮件主题"); //邮件主题 
    //    $mail->setTextBody('测试text'); //发布纯文字文本 
     //   $mail->setHtmlBody("测试html text"); //发送的消息内容 
     //   var_dump($mail->send());
      //  exit;

        $searchModel = new RegionService();
        //检查session是否打开

//        if (!Yii::$app->session->isActive) {
//            Yii::$app->session->open();
//        } else {
//            echo "有session";
//            Yii::$app->session->set('login_sms_time', time());
//            print_r(Yii::$app->session);
//            print_r($_SESSION);
//        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $regionTree=$searchModel->getRegionTree();
        //  $regionChilds=Region::find()->select(["code","parentCode"])->asArray()->all();
        // $regionChilds= $searchModel->getchilds(110100);
      //  $test = Region::find()->where('code=:code', array(':code' => 110100))->asArray()->all();
      //  print_r($test);
       // exit;
        //  print_r($regionChilds);        print_r($regionTree);EXIT;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 短信接口
     */
    public function smsSend() {
        include "TopSdk.php";
        date_default_timezone_set('Asia/Shanghai');
//{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
        $c = new TopClient;
        $c->appkey = '24445262';
        $c->secretKey = 'c4d253919f59ce113a4e235a41c52e9f';
        // $req = new TradeVoucherUploadRequest;
        // $req->setFileName("example");
        // $req->setFileData("@/Users/xt/Downloads/1.jpg");
        // $req->setSellerNick("奥利奥官方旗舰店");
        // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
        // var_dump($c->execute($req));

        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsTemplateCode('SMS_71371004');
        $req->setRecNum('18168736275');
        $smsParams = ["number" => 123];
        $req->setSmsParam(json_encode($smsParams));
        $req->setSmsFreeSignName('寰宇科技');
        $req->setSmsType('normal');
        $req->setExtend('demo');
        var_dump($c->execute($req));
    }

    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * ajax 添加地区信息
     */
    public function actionAdd() {
       // Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Region();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
               return $this->renderAjax('add',['data'=>$model->code]);
            }
        } else {

            return $this->render('add', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Region();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Region model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Region model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
=======
<?php

namespace backend\controllers;

use Yii;
use common\models\Region;
use common\models\service\RegionService;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends BaseController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex() {
        //   $mail = Yii::$app->mailer->compose();
        //   $mail->setTo('2562611287@qq.com'); //要发送给那个人的邮箱 
        ///    $mail->setSubject("邮件主题"); //邮件主题 
        //    $mail->setTextBody('测试text'); //发布纯文字文本 
        //   $mail->setHtmlBody("测试html text"); //发送的消息内容 
        //   var_dump($mail->send());
        //  exit;
        $searchModel = new RegionService();
        $province = [];
        $province = $searchModel->getchilds(100000);
        // print_r($province);exit;
        foreach ($province as $key => $value) {
            $province[$key]["child"] = $searchModel->getchilds($value["code"]);
        }

        //检查session是否打开
//        if (!Yii::$app->session->isActive) {
//            Yii::$app->session->open();
//        } else {
//            echo "有session";
//            Yii::$app->session->set('login_sms_time', time());
//            print_r(Yii::$app->session);
//            print_r($_SESSION);
//        }
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//         $cache = Yii::$app->cache;
//        if (!$cache->exists('regionTreeTable')) {
//        $query = Region::find();
//        $dataProviderTable = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => false
//        ]);
//       // print_r($dataProviderTable);exit;
//         $cache->set('dataProviderTable', $dataProviderTable);
//        }else{
//            $dataProviderTable = $cache->get('dataProviderTable');
//        }
        // print_r($dataProviderTable);exit;
        // $regionTree=$searchModel->getRegionTree();
        // $regionChilds = Region::find()->select(["code", "parentCode"])->asArray()->all();
        // $resultall= $searchModel->subtree($regionChilds);
        //  $regionChilds= $searchModel->getParents(110100);
        //  print_r($regionChilds);exit;
        //  $test = Region::find()->where('code=:code', array(':code' => 110100))->asArray()->all();
        //  print_r($test);
        // exit;
        //  print_r($regionChilds);        print_r($regionTree);EXIT;
        return $this->render('index', [
                    "province" => $province,
//                    "dataProviderTable" => $dataProvider,
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
        ]);
    }

    //ajax获取子集分类信息  
    public function actionRegionChilds() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
             $pid = Yii::$app->request->post("pid");
             $searchModel = new RegionService();
            if (isset($pid)) {
                $regionChilds = $searchModel->getchilds($pid);
                if (!empty($regionChilds)) {
                    return ['code' => true, 'data' => $regionChilds];
                } else {
                    return ['code' => false, 'message' => "暂无数据！"];
                }
            } else {
                return ['code' => false, 'message' => "pid不能为空！"];
            }
        } else {
            return ['code' => false, 'message' => "请求非法！请用ajax在请求！"];
        }
    }

    /**
     * 短信接口
     */
    public function smsSend() {
        include "TopSdk.php";
        date_default_timezone_set('Asia/Shanghai');
//{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
        $c = new TopClient;
        $c->appkey = '24445262';
        $c->secretKey = 'c4d253919f59ce113a4e235a41c52e9f';
        // $req = new TradeVoucherUploadRequest;
        // $req->setFileName("example");
        // $req->setFileData("@/Users/xt/Downloads/1.jpg");
        // $req->setSellerNick("奥利奥官方旗舰店");
        // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
        // var_dump($c->execute($req));

        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsTemplateCode('SMS_71371004');
        $req->setRecNum('18168736275');
        $smsParams = ["number" => 123];
        $req->setSmsParam(json_encode($smsParams));
        $req->setSmsFreeSignName('寰宇科技');
        $req->setSmsType('normal');
        $req->setExtend('demo');
        var_dump($c->execute($req));
    }

    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * ajax 添加地区信息
     */
    public function actionAdd() {
        // Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Region();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $this->renderAjax('add', ['data' => $model->code]);
            }
        } else {

            return $this->render('add', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Region();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Region model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Region model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
>>>>>>> .r156
