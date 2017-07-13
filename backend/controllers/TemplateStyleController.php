<?php

namespace backend\controllers;

class TemplateStyleController extends \merchant\controllers\BaseController
{
    public function actionIcons()
    {
        return $this->render('icons');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionButtons()
    {
        return $this->render('buttons');
    }
	
	public function actionGeneral()
    {
        return $this->render('general');
    }
	

}
