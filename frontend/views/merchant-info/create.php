<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Merchantinfo */

$this->title = 'Create Merchantinfo';
$this->params['breadcrumbs'][] = ['label' => 'Merchantinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchantinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list,
    ]) ?>

</div>
