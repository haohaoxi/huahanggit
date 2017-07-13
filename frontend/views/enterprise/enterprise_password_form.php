<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-5">
<!--            ['action'=>['enterprise/login']]-->
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'placeholder'=>'旧密码'])->label('旧密码') ?>



            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'placeholder'=>'新密码'])->label('新密码') ?>
            <?= $form->field($model, 'reppassword')->passwordInput(['maxlength' => true,'placeholder'=>'确认密码'])->label('确认密码') ?>

            <div class="form-group">
                <?= Html::submitButton('修改密码', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
