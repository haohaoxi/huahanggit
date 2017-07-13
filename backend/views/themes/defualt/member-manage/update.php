<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemberUser */

$this->title = 'Update Member User: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Member Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
