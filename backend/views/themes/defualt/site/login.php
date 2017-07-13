<?php
$this->context->layout = 'main-login'; //设置使用的布局文件
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\forms\LoginForm $model
 */

//$this->title = "登陆";
$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/">Open<b>Adm</b></a>
    </div>
<div class="login-box-body">

    <p class="login-box-msg">用户登陆</p>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'username',['template'=>"<div class=\"form-group has-feedback\">{input}<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span><div class=\"\">{error}</div></div>"])->textInput(['placeholder'=>'Username/Email']) ?>
    <?= $form->field($model, 'password',['template'=>"<div class=\"form-group has-feedback\">{input}<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span><div class=\"\">{error}</div></div>"])->passwordInput(['placeholder'=>'Password']) ?>
    <?= $form->field($model, 'rememberMe', [
        'template' => "{label}<div class=\"form-group\">{input}</div>\n<div class=\"\">{error}</div>",
    ])->checkbox() ?>

    <div class="form-group">
            <?= Html::submitButton('登陆', ['class' => 'btn btn-primary','style'=>'width:100%']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</body>