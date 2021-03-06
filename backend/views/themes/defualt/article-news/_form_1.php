<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use backend\assets\defualt\Select2Asset;
use backend\assets\defualt\UeditorAsset;
/* @var $this yii\web\View */
/* @var $model common\models\ArticleNews */
/* @var $form yii\widgets\ActiveForm */
Select2Asset::register($this); 
UeditorAsset::register($this); 
$articleType=[1=>"是",2=>'否'];
?>

<div class="article-news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cateid')->dropDownList($parentIds, ['prompt'=>'请选择','style'=>'width:800px','id'=>'category-id-form','class' => 'form-control select2']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows'=>6,'id'=>'ueditor','class'=>'']) ?>

    <?= $form->field($model, 'thumb')->widget(
        FileInput::class,
        [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview' => empty($model->thumb)?'':['http://yii2web.vmtest.com/'.'/backend/web/'.$model->thumb],
                'initialPreviewAsData' => true,
            ],
        ]
    ) ?>

    <?= $form->field($model, 'news_summary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'displayorder')->textInput() ?>
 
   <?= $form->field($model, 'is_display')->dropDownList($articleType, ['prompt'=>'请选择','style'=>'width:800px','id'=>'articletype-id','class' => 'form-control select2']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock("uiselect2") ?>
$(".select2").select2();   
        $(function () {
            var ue = UE.getEditor('ueditor', {
            
            });
        });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["uiselect2"], \yii\web\View::POS_END); ?>