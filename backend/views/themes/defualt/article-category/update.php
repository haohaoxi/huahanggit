<?php

use yii\helpers\Html;
use backend\assets\defualt\AppAsset;
//use backend\assets\defualt\Select2Asset;
/* @var $this yii\web\View */
/* @var $model common\models\ArticleCategory */
//Select2Asset::register($this);
$this->title ="Article Category".$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-category-update">

    <h1><?= Html::encode($this->title)?></h1>

    <?= $this->render('_form', [
	    'typeList'=>$typeList,	
	    'parentIds'=>$parentIds,
        'model' => $model,
    ]) ?>

</div>
