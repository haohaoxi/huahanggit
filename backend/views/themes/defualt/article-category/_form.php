<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\defualt\Select2Asset;
/* @var $this yii\web\View */
/* @var $model common\models\ArticleCategory */
/* @var $form yii\widgets\ActiveForm */
Select2Asset::register($this); 
?>

<div class="article-category-form">

    <?php $form = ActiveForm::begin();//print_r($parentIds);?>
	
    <?= $form->field($model, 'type')->dropDownList($typeList, ['prompt'=>'请选择','style'=>'width:300px','id'=>'category-form-type','class' => 'form-control select2']) ?>

    <?= $form->field($model, 'pid')->dropDownList($parentIds, ['prompt'=>'请选择','style'=>'width:800px','id'=>'category-id-form','class' => 'form-control select2']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'style'=>'width:800px']) ?>

    <?= $form->field($model, 'displayorder')->textInput(['style'=>'width:800px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock("uiselect2") ?>
$(".select2").select2();
            $("#category-form-type").change(function () {
				
                var html = '';
                $.ajax({
                    url: '<?= \yii\helpers\Url::to(["/article-category/get-parent-id"]) ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {typeid: $(this).val()},
                    success: function (data) {
                        $.each(data.data, function (key, val) {
							
                            html += '<option value="' + key + '">' + val + '</option>';
                        });
                        $("#category-id-form").html(html);
                    }
                })
            });
        
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["uiselect2"], \yii\web\View::POS_END); ?>