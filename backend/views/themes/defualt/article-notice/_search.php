<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\service\ArticleNoticeService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-notice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cateid') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'thumb') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'displayorder') ?>

    <?php // echo $form->field($model, 'is_display') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <?php // echo $form->field($model, 'click') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
