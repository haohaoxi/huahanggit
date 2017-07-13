<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Demand */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript" src="js/jquery-2.2.4.min"></script>
<?php echo $deman;?>
<div class="demand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'list')->hiddenInput(['maxlength' => true])->label('分类ID') ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'member_user_id')->textInput(['maxlength' => true]) ?>
    <!--    --><?//= $form->field($model, 'demand_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'demand_price')->textInput(['maxlength' => true]) ?>



    <input type="radio" name="phone" checked value="<?= $model->demand_phone;?> ">
    <?= $form->field($model, 'demand_phone')->textInput(['maxlength' => true]) ?>

    <input type="radio" name="phone" value="使用其他号码">
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('使用其他号码') ?>


<!--    --><?//= $form->field($model, 'accessory')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'is_secret')->textInput() ?>

<!--    --><?//= $form->field($model, 'is_delete')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $("document").ready(function(){
        $("#demand-demand_phone").attr("disabled","disabled");
        $("#demand-phone").hide();
        $("#demand-phone").prev().hide();
        $(":radio").click(function(){
            var phone = $('input:radio[name="phone"]:checked').val();
            if(phone =="使用其他号码"){
                $("#demand-phone").show();
                $("#demand-phone").prev().show();
            }else{
                $("#demand-phone").hide();
                $("#demand-phone").prev().hide();
            }
        });
    })
</script>