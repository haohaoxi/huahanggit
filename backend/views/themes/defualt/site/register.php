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
$this->title = Yii::t('user', 'Register');
$this->params['breadcrumbs'][] = $this->title;
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
    <?php $form = ActiveForm::begin(['id' => 'register-form','enableAjaxValidation'=>false,'action' => ['site/register'],'method'=>'post']); ?>

    <?= $form->field($model, 'username',['template'=>"<div class=\"form-group has-feedback\">{input}<span class=\"glyphicon glyphicon-user form-control-feedback\"></span><div class=\"\">{error}</div></div>"])->textInput(['placeholder'=>'Full name']) ?>
	<?= $form->field($model, 'email',['template'=>"<div class=\"form-group has-feedback\">{input}<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span><div class=\"\">{error}</div></div>"])->textInput(['placeholder'=>'Email']) ?>
    <?= $form->field($model, 'password',['template'=>"<div class=\"form-group has-feedback\">{input}<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span><div class=\"\">{error}</div></div>"])->passwordInput(['placeholder'=>'Password']) ?>
    <?= $form->field($model, 'repassword',['template'=>"<div class=\"form-group has-feedback\">{input}<span class=\"glyphicon glyphicon-log-in form-control-feedback\"></span><div class=\"\">{error}</div></div>"])->passwordInput(['placeholder'=>'Retype Password']) ?>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
        	<?= $form->field($model, 'rememberMe', ['template' => "{label}<div class=\"form-group\">{input}</div>\n<div class=\"\">{error}</div>"])->checkbox() ?>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
           <?= Html::submitButton('登陆', ['class' => 'btn btn-primary btn-block btn-flat']) ?>
        </div>		
        <!-- /.col -->
      </div>
    <?php ActiveForm::end(); ?>
	<a href="login.html" class="text-center">I already have a membership ,I agree to th terms.</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
</body>
