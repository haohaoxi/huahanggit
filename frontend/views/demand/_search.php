<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\service\DemandService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demand-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'member_user_id') ?>

    <?= $form->field($model, 'demand_price') ?>

    <?php // echo $form->field($model, 'demand_time') ?>

    <?php // echo $form->field($model, 'demand_phone') ?>

    <?php // echo $form->field($model, 'accessory') ?>

    <?php // echo $form->field($model, 'is_secret') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
