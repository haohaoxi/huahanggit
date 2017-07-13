<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'card')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'principal_idcard_img')->fileInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'principal_idcard_img2')->fileInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'business_license_num')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'business_license_img')->fileInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'add')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'abstract')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ])->label('验证码') ?>


            <div class="form-group">
                <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
