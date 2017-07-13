<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Classcationadmin */

$this->title = 'Update Classcationadmin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Classcationadmins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="classcationadmin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list,
    ]) ?>

</div>
