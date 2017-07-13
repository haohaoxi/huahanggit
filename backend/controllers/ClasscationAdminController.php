<?php

namespace backend\controllers;

use Yii;
use common\models\ClasscationAdmin;
use backend\models\Classadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ClasscationAdminController implements the CRUD actions for ClasscationAdmin model.
 */
class ClasscationAdminController extends Controller
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
//                    'delete' => ['POST'],/
                ],
            ],
        ];
    }

    /**
     * Lists all ClasscationAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ClasscationAdmin::find(),
        ]);
        $cat=new Classadmin('',array('id','praent_id','categoryname','fullname'));
        $data=$cat->getTree(ClasscationAdmin::get_menus(true));//获取分类结构
        $this->getView()->title = '菜单管理';
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'data' => $data,
        ]);
    }

    /**
     * Displays a single ClasscationAdmin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClasscationAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClasscationAdmin();
        if ($model->load(Yii::$app->request->post())) {
            date_default_timezone_set("Asia/Shanghai");
            $model->createtime = date("Y-m-d H-i-s",time());
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $cat=new Classadmin('',array('id','praent_id','categoryname','fullname'));
            $_list=$cat->getTree(ClasscationAdmin::get_menus(true));//获取分类结构
            $list = array('0'=>'顶级菜单');
            foreach($_list as $value){
                $list[$value['id']] = $value['fullname'];
            }
            return $this->render('create', [
                'model' => $model,
                'list' => $list,
            ]);
        }
    }

    /**
     * Updates an existing ClasscationAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            date_default_timezone_set("Asia/Shanghai");
            $model->updatetime = date("Y-m-d H-i-s",time());
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $cat=new Classadmin('',array('id','praent_id','categoryname','fullname'));
            $_list=$cat->getTree(ClasscationAdmin::get_menus(true));//获取分类结构
            $list = array('0'=>'顶级菜单');
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
     * Deletes an existing ClasscationAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
//     */
    public function actionDelete($id)
    {
        $del_ids = Classadmin::get_ids($id);
        if($del_ids != ''){
            $del_ids = $id.','.substr($del_ids,0,-1); //删除ids
        }else{
            $del_ids = $id;
        }
        ClasscationAdmin::deleteAll("id in ($del_ids)");
        return $this->redirect(['index']);
    }

    /**
     * Finds the ClasscationAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClasscationAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClasscationAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
