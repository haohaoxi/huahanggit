<<<<<<< .mine
<?php

namespace backend\controllers;

use Yii;
use common\models\ArticleNews;
use common\models\service\ArticleCategoryService;
use common\models\service\ArticleNewsService;
use backend\controllers\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleNewsController implements the CRUD actions for ArticleNews model.
 */
class ArticleNewsController extends BaseController {

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
     * Lists all ArticleNews models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleNewsService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleNews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleNews();
        $articleCategoryService = new ArticleCategoryService();
        $parentIds = $articleCategoryService->getOptions(null, 2);

        // print_r($parentIds);exit;
        if ($model->load(Yii::$app->request->post())) {
            $filemodel = UploadedFile::getInstance($model, 'thumb');
            if ($filemodel) {
                $filemodel->saveAs('uploads/' . $filemodel->baseName . '.' . $filemodel->extension);
                $model->thumb = 'uploads/' . $filemodel->baseName . '.' . $filemodel->extension;
            } else {
                $model->thumb = "";
            }
            // print_r($model);exit;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $filemodel = UploadedFile::getInstance($model, 'thumb');
            if ($filemodel) {
                $filemodel->saveAs('uploads/' . $filemodel->baseName . '.' . $filemodel->extension);
                $model->thumb = 'uploads/' . $filemodel->baseName . '.' . $filemodel->extension;
            } else {
                $model->thumb = "";
            }
            // print_r($model);exit;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $articleCategoryService = new ArticleCategoryService();
            $parentIds = $articleCategoryService->getOptions(null, 2);

            return $this->render('update', [
                 'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleNews::findOne($id)) !== null) {
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
use common\models\ArticleNews;
use common\models\service\ArticleCategoryService;
use common\models\service\ArticleNewsService;
use backend\controllers\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleNewsController implements the CRUD actions for ArticleNews model.
 */
class ArticleNewsController extends BaseController {

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
     * Lists all ArticleNews models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleNewsService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleNews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleNews();
        $articleCategoryService = new ArticleCategoryService();
        $parentIds = $articleCategoryService->getOptions(null, 2);

        // print_r($parentIds);exit;
        if ($model->load(Yii::$app->request->post())) {
            $filemodel = UploadedFile::getInstance($model, 'thumb');
            if ($filemodel) {
                $filemodel->saveAs('uploads/' . $filemodel->baseName . '.' . $filemodel->extension);
                $model->thumb = 'uploads/' . $filemodel->baseName . '.' . $filemodel->extension;
            } else {
                $model->thumb = "";
            }
            // print_r($model);exit;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $filemodel = UploadedFile::getInstance($model, 'thumb');
            if ($filemodel) {
                $filemodel->saveAs('uploads/' . $filemodel->baseName . '.' . $filemodel->extension);
                $model->thumb = 'uploads/' . $filemodel->baseName . '.' . $filemodel->extension;
            } else {
                $model->thumb = "";
            }
            // print_r($model);exit;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $articleCategoryService = new ArticleCategoryService();
            $parentIds = $articleCategoryService->getOptions(null, 2);

            return $this->render('update', [
                 'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleNews::findOne($id)) !== null) {
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
use common\models\ArticleNews;
use common\models\service\ArticleCategoryService;
use common\models\service\ArticleNewsService;
use backend\controllers\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleNewsController implements the CRUD actions for ArticleNews model.
 */
class ArticleNewsController extends BaseController {

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

    public function actions() {
        return [
        'upload' => [
        'class' => 'kucha\ueditor\UEditorAction',
        'config' => [
        "imageUrlPrefix" => "http://yii2web.vmtest.com/", //图片访问路径前缀
        "imagePathFormat" => "/uedit_uploads/image/{yyyy}{mm}{dd}/{time}{rand:6}" ,//上传保存路径
        "imageRoot" => Yii::getAlias("@webroot"),
        ],
        ]
        ];
    }

    /**
     * Lists all ArticleNews models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleNewsService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleNews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleNews();
        $articleCategoryService = new ArticleCategoryService();
        $parentIds = $articleCategoryService->getOptions(null, 2);

        // print_r($parentIds);exit;
        if ($model->load(Yii::$app->request->post())) {
            $filemodel = UploadedFile::getInstance($model, 'thumb');
            if ($filemodel) {
                $filemodel->saveAs('uploads/' . $filemodel->baseName . '.' . $filemodel->extension);
                $model->thumb = 'uploads/' . $filemodel->baseName . '.' . $filemodel->extension;
            } else {
                $model->thumb = "";
            }
            // print_r($model);exit;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $filemodel = UploadedFile::getInstance($model, 'thumb');
           // print_r(Yii::$app->request->post());exit;
            if ($filemodel) {
                $filemodel->saveAs('uploads/' . $filemodel->baseName . '.' . $filemodel->extension);
                $model->thumb = 'uploads/' . $filemodel->baseName . '.' . $filemodel->extension;
            } else {
                $model->setScenario('updatenoimg'); 
               // $model->thumb = Yii::$app->request->post("thumb");
            }
            // print_r($model);exit;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $articleCategoryService = new ArticleCategoryService();
            $parentIds = $articleCategoryService->getOptions(null, 2);

            return $this->render('update', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleNews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
>>>>>>> .r156
