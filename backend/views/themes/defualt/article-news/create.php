<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ArticleNews */

$this->title = 'Create Article News';
$this->params['breadcrumbs'][] = ['label' => 'Article News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'parentIds'=>$parentIds,
        'model' => $model,
    ]) ?>

</div>
