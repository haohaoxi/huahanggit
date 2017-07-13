<?php
namespace backend\controllers;

use Yii;
use backend\controllers\BaseController;
use common\models\MerchantInfo;
use common\models\service\MerchantInfoService;
use yii\web\NotFoundHttpException;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * Description of MerchantManageController
 *
 * @author Administrator
 */
class MerchantManageController extends BaseController {

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
     * Lists all MerchantInfo models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new MerchantInfoService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all MerchantInfo models.
     * @return mixed
     */
    public function actionList() {

        $searchModel = new MerchantInfoService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single MerchantInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MerchantInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MerchantInfo();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            $model->principal_idcard_img = UploadedFile::getInstance($model, 'principal_idcard_img');
            if ($model->principal_idcard_img) {
                $model->principal_idcard_img->saveAs('uploads/' . $model->principal_idcard_img->baseName . '.' . $model->principal_idcard_img->extension);
                $model->principal_idcard_img = 'uploads/' . $model->principal_idcard_img->baseName . '.' . $model->principal_idcard_img->extension;
            } else {
                $model->principal_idcard_img = "";
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            //  echo "ok";exit;
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MerchantInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->setScenario('update');
        //$model->touch("rejected_time");//更新时间戳字段值为当前
        if ($model->load(Yii::$app->request->post())) {
            $model->principal_idcard_img = UploadedFile::getInstance($model, 'principal_idcard_img');
            if ($model->principal_idcard_img) {
                $model->principal_idcard_img->saveAs('uploads/' . $model->principal_idcard_img->baseName . '.' . $model->principal_idcard_img->extension);
                $model->principal_idcard_img = 'uploads/' . $model->principal_idcard_img->baseName . '.' . $model->principal_idcard_img->extension;
            } else {
                $model->principal_idcard_img = "";
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MerchantInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MerchantInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MerchantInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MerchantInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
