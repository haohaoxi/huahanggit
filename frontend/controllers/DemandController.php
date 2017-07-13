<?php

namespace frontend\controllers;

use common\models\EnterpriseUser;
use Yii;
use common\models\Demand;
use common\models\service\DemandService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Category;
use common\models\model\Demandmodel;

/**
 * DemandController implements the CRUD actions for Demand model.
 */
class DemandController extends Controller
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
     * Lists all Demand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DemandService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Demand model.
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
     * Creates a new Demand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Demand();
        $demandmodl = new Demandmodel();
       $deman = $demandmodl->classification($_GET['id']);//获取分类所有分类显示名称
        $enterprese_phone = EnterpriseUser::find()->select('phone')->where(['id'=>Yii::$app->user->id])->asArray()->one();
        $model->demand_phone = $enterprese_phone['phone'];
        $model->list = $_GET['id'];//提交分类ID
        if ($model->load(Yii::$app->request->post())) {
            if($_POST['Demand']['phone']!=""){
                $model->demand_phone = $_POST['Demand']['phone']; //重新输入的手机号码
            }else{
                $model->demand_phone = $enterprese_phone['phone']; //获取用户表手机号码
            }
            $model->member_user_id = Yii::$app->user->id;
            $model->demand_time = time();
            $model->is_delete = 1;
            $model->created_at = time();
            $model->accessory = "1";
            $model->save();
            $id = $model->attributes['id'];//获取当前存储自增ID
            if(!empty($id)){
                $demans = $demandmodl->denadnlist($_GET['id']); //获取此分类到最顶级id
                $connection = Yii::$app->db;
                //发布需求添加分类到发布分类表
                $demand_extend =$connection->createCommand()->insert('hhqy_demand_extend', [
                    'demand_id' => $id,
                    'category_id_1' => $demans[2],
                    'category_id_2' => $demans[1],
                    'category_id_3' => $demans[0],
                    'category_id_4' => "",
                    'category_id_5' => "",
                    'category_id_6' => "",
                    'province_id' => "",
                    'city_id' => "",
                    'area_id' => "",
                    'price' => $model->attributes['demand_price'],
                    'sort' => 1,
                    'created_at' => time(),
                    'updated_at' => 312123,
                ])->execute();
                if(!$enterprise_user_extend = Yii::$app->db->createCommand("select * from hhqy_demand_extend where demand_id = $id")->queryOne()){
                    Demand::deleteAll(['id' =>$id]);
                }else{
                    Yii::$app->getSession()->setFlash('success', '发布成功');
                    return $this->redirect(array("/enterprise/personal"));
                }

            }else{
                Yii::$app->getSession()->setFlash('success', '需求发布失败请重新提交');
                return $this->render('create', [
                    'model' => $model,
                    'deman'=>$deman,
                ]);
            }
            Yii::$app->getSession()->setFlash('success', '发表成功');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'deman'=>$deman,
            ]);
        }
    }

    //需求展示
    public  function actionRelease(){


    }

    /**
     * Updates an existing Demand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Demand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    //发布需求顶底分类
    public function actionRequire_ments(){
        $category = Category::find()->select(['id','category_name'])->where(['pid'=>0])->asArray()->all();
        return $this->render('require_ments',[
            'category'=>$category,
        ]);
    }

    public function actionAjax(){
        return $this->redirect(array('/demand/create','id'=>$_GET['inval']));
    }

    /**
     * Finds the Demand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Demand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Demand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
