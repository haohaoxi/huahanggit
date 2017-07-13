<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'account')->textInput(['maxlength' => true])->label('会员账户11') ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('会员名称11') ?>

            <?= $form->field($model, 'passwd')->passwordInput(['maxlength' => true])->label('密码11') ?>

            <?= $form->field($model, 'telnum')->textInput(['maxlength' => true])->label('手机号码11') ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('邮箱111') ?>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
