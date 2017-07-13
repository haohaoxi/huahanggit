<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\service\MerchantinfoService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchantinfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'merchant_name') ?>

    <?= $form->field($model, 'merchant_address_details') ?>

    <?= $form->field($model, 'member_id') ?>

    <?= $form->field($model, 'industry_type') ?>

    <?php // echo $form->field($model, 'merchant_info_details') ?>

    <?php // echo $form->field($model, 'principal_name') ?>

    <?php // echo $form->field($model, 'principal_idcard_img') ?>

    <?php // echo $form->field($model, 'principal_idcard_img2') ?>

    <?php // echo $form->field($model, 'business_license_num') ?>

    <?php // echo $form->field($model, 'business_license_img') ?>

    <?php // echo $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'audit_state') ?>

    <?php // echo $form->field($model, 'audit_time') ?>

    <?php // echo $form->field($model, 'rejected_time') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
