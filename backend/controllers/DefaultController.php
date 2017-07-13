<?php

namespace backend\controllers;

use Yii;
use backend\controllers\BaseController;
/**
 * DefaultController
 *
 * @author cbn
 * @since 1.0
 */
class DefaultController extends BaseController
{

    /**
     * Action index
     */
    public function actionIndex($page = 'README.md')
    {
        if (strpos($page, '.png') !== false) {
            $file = Yii::getAlias("@backend/{$page}");
            return Yii::$app->getResponse()->sendFile($file);
        }
       
        return $this->render('index', ['page' => $page]);
    }
}
