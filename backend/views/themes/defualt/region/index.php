<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\defualt\TreeAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\service\RegionService */
/* @var $dataProvider yii\data\ActiveDataProvider */
TreeAsset::register($this);
$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?php
        echo Html::a('添加地区', ['create'], ['class' => 'btn btn-success'])
        ?>
    <?= Html::a('Create Region', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            'parentCode',
            'type',
            'name',
            'fullName',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?></div>
<div>
   <ul id="treeDemo" class="ztree"></ul>
</div>

 <?php $this->beginBlock("treeDemo") ?>
   var zTreeObj;
   // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
   var setting = {};
   // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
   var zNodes = [
   {name:"test1", open:true, children:[
      {name:"test1_1"}, {name:"test1_2"}]},
   {name:"test2", open:true, children:[
      {name:"test2_1"}, {name:"test2_2"}]}
   ];
   $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
   });  
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["treeDemo"], \yii\web\View::POS_END); ?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\defualt\TreeAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\service\RegionService */
/* @var $dataProvider yii\data\ActiveDataProvider */
TreeAsset::register($this);
$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?php
        echo Html::a('添加地区', ['create'], ['class' => 'btn btn-success'])
        ?>
    <?= Html::a('Create Region', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            'parentCode',
            'type',
            'name',
            'fullName',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?></div>
<div>
   <ul id="treeDemo" class="ztree"></ul>
</div>

 <?php $this->beginBlock("treeDemo") ?>
   var zTreeObj;
   // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
   var setting = {};
   // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
   var zNodes = [
   {name:"test1", open:true, children:[
      {name:"test1_1"}, {name:"test1_2"}]},
   {name:"test2", open:true, children:[
      {name:"test2_1"}, {name:"test2_2"}]}
   ];
   $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
   });  
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["treeDemo"], \yii\web\View::POS_END); ?>
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\defualt\TreeAsset;
use leandrogehlen\treegrid\TreeGrid;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\service\RegionService */
/* @var $dataProvider yii\data\ActiveDataProvider */
TreeAsset::register($this);
$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    <p>
        <?php
        echo Html::a('添加地区', ['create'], ['class' => 'btn btn-success'])
        ?>
        <?= Html::a('Create Region', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div id="leftnav" class="col-md-3">
            <div class="list-group">
                <?php   foreach ($province as $key => $value) {?>
                <!-- 地址管理 -->
                <a class="list-group-item" data-toggle="collapse" href="#province-<?=$key?>" aria-expanded="true" ><?=$value['name']?><small>(<?=$value['code']?>)</small><span class="caret"></span></a>
                <div class="collapse" id="province-<?=$key?>">
                    <div class="well" style="padding:0;margin: 0;">
                        <div class="list-group" style="margin: 0;">
                            <?php if(!empty($province[$key]['child'])){   foreach ($province[$key]['child'] as $citykey => $cityvalue) { ?>
                            <a href="javascript:void(0);" id="city-<?=$citykey?>" data-cityid="<?=$cityvalue["code"]?>" class="citydata list-group-item" style="padding-left: 36px;margin: 0;"><span class="glyphicon glyphicon-forward"></span><?=$cityvalue['name']?><small>(<?=$cityvalue['code']?>)</small></a>
                           <?php  }}else{?>
                            <a href="javascript:void(0);" class="list-group-item">暂无数据</a>
                           <?php }?>
                        </div>
                    </div>
                </div>
                      <?php   } ?>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">地区列表</h3>
                </div>
                <div class="panel-body" id="areacontent">
                    <h1>地区列表</h1>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<?php $this->beginBlock("treeDemo") ?>
$('.well>.list-group>a').each(function(index){
    $(this).on('click',function(){
    var pid=$(this).attr("data-cityid");
      $.ajax({
        url:  "<?=Url::to(['region/region-childs']);?>",
        type: 'post',
        dataType:'json',
        data: {"pid":pid},
        success: function (data) { 
            var tpl = $('#areatpl').html();
            var areatmp=template(tpl, {list: data.data});
            $("#areacontent").html(areatmp);
        },
        error: function(data) {
        alert(data.message);
          },
        });
    });
  });

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["treeDemo"], \yii\web\View::POS_END); ?>
<script id="areatpl" type="text/html">

    <%for(var i = 0; i < list.length; i++) {%>

    <div class="page-header">
    <h3><%:=list[i].name%>
        <small><%:=list[i].fullName%>（<%:=list[i].code%>）</small>
    </h3>
</div>

    <%}%>

</script>
