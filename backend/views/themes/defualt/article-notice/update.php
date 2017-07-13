<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleNotice */

$this->title = 'Update Article Notice: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Article Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-notice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'parentIds' => $parentIds,
        'model' => $model,
    ])
    ?>

</div>
