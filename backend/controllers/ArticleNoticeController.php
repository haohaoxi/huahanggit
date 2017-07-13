<<<<<<< .mine
<?php

namespace backend\controllers;

use Yii;
use common\models\ArticleNotice;
use common\models\service\ArticleCategoryService;
use common\models\service\ArticleNoticeService;
use backend\controllers\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleNoticeController implements the CRUD actions for ArticleNotice model.
 */
class ArticleNoticeController extends BaseController {

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
     * Lists all ArticleNotice models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleNoticeService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleNotice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleNotice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleNotice();

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
            $noticeCategoryService = new ArticleCategoryService();
            $parentIds = $noticeCategoryService->getOptions(null, 3);
            return $this->render('create', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleNotice model.
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
            $noticeCategoryService = new ArticleCategoryService();
            $parentIds = $noticeCategoryService->getOptions(null, 3);

            return $this->render('update', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleNotice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleNotice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleNotice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleNotice::findOne($id)) !== null) {
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
use common\models\ArticleNotice;
use common\models\service\ArticleCategoryService;
use common\models\service\ArticleNoticeService;
use backend\controllers\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleNoticeController implements the CRUD actions for ArticleNotice model.
 */
class ArticleNoticeController extends BaseController {

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
     * Lists all ArticleNotice models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleNoticeService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleNotice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleNotice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleNotice();

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
            $noticeCategoryService = new ArticleCategoryService();
            $parentIds = $noticeCategoryService->getOptions(null, 3);
            return $this->render('create', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleNotice model.
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
            $noticeCategoryService = new ArticleCategoryService();
            $parentIds = $noticeCategoryService->getOptions(null, 3);

            return $this->render('update', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleNotice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleNotice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleNotice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleNotice::findOne($id)) !== null) {
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
use common\models\ArticleNotice;
use common\models\service\ArticleCategoryService;
use common\models\service\ArticleNoticeService;
use backend\controllers\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleNoticeController implements the CRUD actions for ArticleNotice model.
 */
class ArticleNoticeController extends BaseController {

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
                    "imagePathFormat" => "/uedit_uploads/image/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
                    "imageRoot" => Yii::getAlias("@webroot"),
                ],
            ]
        ];
    }

    /**
     * Lists all ArticleNotice models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticleNoticeService();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleNotice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleNotice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ArticleNotice();

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
            $noticeCategoryService = new ArticleCategoryService();
            $parentIds = $noticeCategoryService->getOptions(null, 3);
            return $this->render('create', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleNotice model.
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
                $model->setScenario('updatenoimg'); 
               // $model->thumb = "";
            }
            // print_r($model);exit;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $noticeCategoryService = new ArticleCategoryService();
            $parentIds = $noticeCategoryService->getOptions(null, 3);

            return $this->render('update', [
                        'parentIds' => $parentIds,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleNotice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleNotice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleNotice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ArticleNotice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
>>>>>>> .r156
