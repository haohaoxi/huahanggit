<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '更新';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>



            <?= $form->field($model, 'card')->textInput(['maxlength' => true])->label('身份证号码') ?>

            <?= $form->field($model, 'principal_idcard_img')->fileInput(['maxlength' => true])->label('身份证正面') ?>

            <?= $form->field($model, 'principal_idcard_img2')->fileInput(['maxlength' => true])->label('身份证反面') ?>

            <?= $form->field($model, 'business_license_num')->textInput(['maxlength' => true])->label('营业执照号') ?>

            <?= $form->field($model, 'business_license_img')->fileInput(['maxlength' => true])->label('营业执照图片') ?>

            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true])->label('公司名称') ?>

            <?= $form->field($model, 'add')->textInput(['maxlength' => true])->label('公司地址') ?>

            <?= $form->field($model, 'abstract')->textInput(['maxlength' => true])->label('公司简介') ?>


<!--            --><?//= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//            ]) ?>


            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
