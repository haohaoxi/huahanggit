<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EnterpriseUserAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enterprise-user-admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_idcard_img')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'principal_idcard_img2')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_license_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_license_img')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'add')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abstract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'开启','2'=>'关闭']) ?>

    <?= $form->field($model, 'status2')->dropDownList(['1'=>'通过','2'=>'审核','3'=>'未通过']) ?>

    <?= $form->field($model, 'level_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
