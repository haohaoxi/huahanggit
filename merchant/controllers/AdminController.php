<?php

namespace merchant\controllers;

class AdminController extends \merchant\controllers\BaseController
{
    public function actionDel()
    {
        return $this->render('del');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
