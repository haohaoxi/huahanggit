<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleNotice */

$this->title = 'Create Article Notice';
$this->params['breadcrumbs'][] = ['label' => 'Article Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'parentIds' => $parentIds,
        'model' => $model,
    ])
    ?>

</div>
