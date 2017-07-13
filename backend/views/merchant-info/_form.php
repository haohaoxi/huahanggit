<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Merchantinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchantinfo-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'merchant_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchant_address_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= html_entity_decode($form->field($model, 'industry_type')->dropDownList($list,['maxlength' => true])) ?>

    <?= $form->field($model, 'merchant_info_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'principal_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_idcard_img')->widget(
        FileInput::class,
        [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview' => empty($model->principal_idcard_img)?'':['http://huahangxq.com/'.'/'.$model->principal_idcard_img],
                'initialPreviewAsData' => true,
            ],
        ]
    ) ?>

    <?= $form->field($model, 'principal_idcard_img2')->widget(FileInput::class,
        [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview' => empty($model->principal_idcard_img2)?'':['http://huahangxq.com/'.'/'.$model->principal_idcard_img2],
                'initialPreviewAsData' => true,
            ],
//            'pluginEvents' => [
//                "fileclear" => "function() { $('#products-image').val('');}",
//            ],
        ]) ?>

    <?= $form->field($model, 'business_license_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_license_img')->widget(FileInput::class,
        [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview' => empty($model->business_license_img)?'':['http://huahangxq.com/'.'/'.$model->business_license_img],
                'initialPreviewAsData' => true,
            ],
            'pluginEvents' => [
                "fileclear" => "function() { $('#products-image').val('');}",
            ],
        ]) ?>

    <?= $form->field($model, 'group_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'正常','2'=>'关闭']) ?>

    <?= $form->field($model, 'audit_state')->dropDownList(['1'=>'审核中','2'=>'未通过','3'=>'通过','4'=>'待完善']) ?>

    <?= $form->field($model, 'audit_time')->textInput() ?>

    <?= $form->field($model, 'rejected_time')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
