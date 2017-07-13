<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MerchantInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchant-info-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'merchant_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchant_address_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'industry_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchant_info_details')->textarea(['rows' => 6]) ?>

   <?= $form->field($model, 'principal_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_idcard_img')->fileInput() ?>
    <?php if($model->principal_idcard_img){  ?>
    <?=Html::img($model->principal_idcard_img,['width'=>'40','height'=>'30','alt'=>"身份证照片"]) ?>
    <?php } ?>
    <?= $form->field($model, 'principal_idcard_img2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_license_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_license_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'audit_state')->textInput() ?>

    <?= $form->field($model, 'audit_time')->textInput() ?>

    <div class="form-group">
       <?php echo Html::submitButton($model->getIsNewRecord() ? 'Create': 'Update', ['class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
