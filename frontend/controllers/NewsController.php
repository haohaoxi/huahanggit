<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use merchant\controllers\BaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\service\ArticleNewsService;
use yii\data\Pagination;

/**
 * Site controller
 */
class NewsController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $ArticleNewsService=new ArticleNewsService();
       
        $pagination = new Pagination([  
            'defaultPageSize' => 1,  
            'totalCount' => $ArticleNewsService->getcount(),  
        ]); 
        $articleList=$ArticleNewsService->getArticleList($articleCond=[],$pagination);
        return $this->render('index',["article_list"=>$articleList,"pagination"=>$pagination]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionNewsList()
    {

    }
}
