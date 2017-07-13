<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\defualt\TreeAsset;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $searchModel common\models\service\RegionService */
/* @var $dataProvider yii\data\ActiveDataProvider */
TreeAsset::register($this);
$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" 
                href="#collapseOne">
                点击我进行展开，再次点击我进行折叠。第 1 部分
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
                cred nesciunt sapiente ea proident. Ad vegan excepteur butcher 
                vice lomo.
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" 
                href="#collapseTwo">
                点击我进行展开，再次点击我进行折叠。第 2 部分
            </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
            Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
            cred nesciunt sapiente ea proident. Ad vegan excepteur butcher 
            vice lomo.
        </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" 
                href="#collapseThree">
                点击我进行展开，再次点击我进行折叠。第 3 部分
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
                cred nesciunt sapiente ea proident. Ad vegan excepteur butcher 
                vice lomo.
            </div>
        </div>
    </div>
</div>
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

  <?= TreeGrid::widget([
      'dataProvider' =>   $dataProviderTable,
      'keyColumnName' => 'code',
      'parentColumnName' => 'parentCode',
      'columns' => [
          'name',
          'code',
          'type',
          'fullName',
          ['class' => 'yii\grid\ActionColumn']
      ]        
  ]); ?>    
    
</div>
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
<?php //$this->registerJs($this->blocks["treeDemo"], \yii\web\View::POS_END); ?>
