<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Classcationadmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classcationadmin-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= html_entity_decode($form->field($model, 'praent_id')->dropDownList($list,['class'=>'q disabled'])) ?>

    <?= $form->field($model, 'categoryname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sorting')->textInput() ?>

    <?= $form->field($model, 'controller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_show')->textInput() ?>

    <?= $form->field($model, 'is_sun')->textInput() ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'updatetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
