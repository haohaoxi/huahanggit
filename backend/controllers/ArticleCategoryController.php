<<<<<<< .mine
<?php

namespace backend\controllers;

use Yii;
use common\models\ArticleCategory;
use common\models\service\ArticleCategoryService;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Json;
/**
 * ArticleCategoryController implements the CRUD actions for ArticleCategory model.
 */
class ArticleCategoryController extends BaseController {
	//新闻分类类型
    public $type=2;
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
     * Lists all ArticleCategory models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleCategoryService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    // 看主要的验证操作，该操作是表单字段失去焦点时异步验证，同时如果直接提交表单，也会先执行该操作进行验证
    public function actionValidateForm() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Model();
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }

    /**
     * Creates a new ArticleCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleCategory();
        $parentIds = [];
        $model->setScenario('register'); 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
		$articleCategoryService=new ArticleCategoryService();
		$parentIds = $articleCategoryService->getOptions($this->type);
		$typeList =  $articleCategoryService->getTypes();
            return $this->render('create', [
					    'typeList'=>$typeList,
                        'parentIds'=>$parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
		$model->setScenario("update");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
        $articleCategoryService=new ArticleCategoryService();
        $parentIds = [];
		$parentIds = $articleCategoryService->getOptions($this->type);
		$typeList =  $articleCategoryService->getTypes();

            return $this->render('update', [
			            'typeList'=>$typeList,
                        'parentIds'=>$parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
	 *异步获取文章分类
	 */
	 public function actionGetParentId(){
		// print_r("www");exit;
		 Yii::$app->response->format=Response::FORMAT_JSON;
		 $articleCategoryService=new ArticleCategoryService();
		 $parentIds = $articleCategoryService->getOptions(null,Yii::$app->request->post('typeid'));
         return ['code'=>"200",'data'=>$parentIds,'msg'=>"文章分类"];
		 
		 
	 }
    /**
     * Finds the ArticleCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleCategory::findOne($id)) !== null) {
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
use common\models\ArticleCategory;
use common\models\service\ArticleCategoryService;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Json;
/**
 * ArticleCategoryController implements the CRUD actions for ArticleCategory model.
 */
class ArticleCategoryController extends BaseController {
	//新闻分类类型
    public $type=2;
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
     * Lists all ArticleCategory models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleCategoryService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    // 看主要的验证操作，该操作是表单字段失去焦点时异步验证，同时如果直接提交表单，也会先执行该操作进行验证
    public function actionValidateForm() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Model();
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }

    /**
     * Creates a new ArticleCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleCategory();
        $parentIds = [];
        $model->setScenario('register'); 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
		$articleCategoryService=new ArticleCategoryService();
		$parentIds = $articleCategoryService->getOptions($this->type);
		$typeList =  $articleCategoryService->getTypes();
            return $this->render('create', [
					    'typeList'=>$typeList,
                        'parentIds'=>$parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
		$model->setScenario("update");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
        $articleCategoryService=new ArticleCategoryService();
        $parentIds = [];
		$parentIds = $articleCategoryService->getOptions($this->type);
		$typeList =  $articleCategoryService->getTypes();

            return $this->render('update', [
			            'typeList'=>$typeList,
                        'parentIds'=>$parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
	 *异步获取文章分类
	 */
	 public function actionGetParentId(){
		// print_r("www");exit;
		 Yii::$app->response->format=Response::FORMAT_JSON;
		 $articleCategoryService=new ArticleCategoryService();
		 $parentIds = $articleCategoryService->getOptions(null,Yii::$app->request->post('typeid'));
         return ['code'=>"200",'data'=>$parentIds,'msg'=>"文章分类"];
		 
		 
	 }
    /**
     * Finds the ArticleCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleCategory::findOne($id)) !== null) {
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
use common\models\ArticleCategory;
use common\models\service\ArticleCategoryService;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
/**
 * ArticleCategoryController implements the CRUD actions for ArticleCategory model.
 */
class ArticleCategoryController extends BaseController {

    //新闻分类类型
    public $type = 2;

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
     * Lists all ArticleCategory models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleCategoryService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->pagination->defaultPageSize =3;
        $query = ArticleCategory::find();
        $dataProviderTable = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $this->render('index', [
                    "dataProviderTable" => $dataProvider,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    // 看主要的验证操作，该操作是表单字段失去焦点时异步验证，同时如果直接提交表单，也会先执行该操作进行验证
    public function actionValidateForm() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Model();
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }

    /**
     * Creates a new ArticleCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleCategory();
        $parentIds = [];
        $model->setScenario('register');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $articleCategoryService = new ArticleCategoryService();
            $parentIds = $articleCategoryService->getOptions($this->type);
            $typeList = $articleCategoryService->getTypes();
            return $this->render('create', [
                        'typeList' => $typeList,
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->setScenario("update");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $articleCategoryService = new ArticleCategoryService();
            $parentIds = [];
            $parentIds = $articleCategoryService->getOptions($this->type);
            $typeList = $articleCategoryService->getTypes();

            return $this->render('update', [
                        'typeList' => $typeList,
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * 异步获取文章分类
     */
    public function actionGetParentId() {
        // print_r("www");exit;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $articleCategoryService = new ArticleCategoryService();
        $parentIds = $articleCategoryService->getOptions(null, Yii::$app->request->post('typeid'));
        return ['code' => "200", 'data' => $parentIds, 'msg' => "文章分类"];
    }

    /**
     * Finds the ArticleCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
>>>>>>> .r156
