<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\service\EnterpriseUserAdminService;
use yii\grid\CheckboxColumn;
use backend\assets\defualt\AppAsset;



/* @var $this yii\web\View */
/* @var $searchModel common\models\service\EnterpriseUserAdminService */
/* @var $dataProvider yii\data\ActiveDataProvider */
AppAsset::register($this);
AppAsset::addScript($this,'morris.min.js');
$this->title = 'Enterprise User Admins';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enterprise-user-admin-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button("删除",['class'=>'btn btn-red'])?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            ['class' => CheckboxColumn::className(),'options'=>['style'=>'width:20px']],
            [
                'attribute'=>'id',
                'options'=>['style'=>'width:20px'],
            ],
            [
                'attribute'=>'account',
                'options'=>['style'=>'width:100px'],
            ],
            [
                'attribute'=>'phone',
                'options'=>['style'=>'width:100px'],
            ],
//            [
//                'attribute'=>'card',
//                'options'=>['style'=>'width:80px'],
//            ],
            [
                    'attribute' => 'principal_idcard_img', 'options'=>['style'=>'width:200px'], 'label' =>'图片', 'format' => 'raw',
                'value' => function ($model){return  Html::img('http://huahangxq.com/'.'/'.$model->principal_idcard_img, ['width' => 120,'height'=>60]);}
            ],
            [
                'attribute' => 'principal_idcard_img2','options'=>['style'=>'width:200px'], 'label' =>'图片', 'format' => 'raw',
                'value' => function ($model){return  Html::img('http://huahangxq.com/'.'/'.$model->principal_idcard_img2, ['width' => 120,'height'=>60]);}
            ],
//            [
//                'attribute'=>'business_license_num',
//                'options'=>['style'=>'width:80px'],
//            ],
//            [
//                'attribute' => 'business_license_img', 'label' =>'图片', 'format' => 'raw',
//                'value' => function ($model){return  Html::img('http://huahangxq.com/'.'/'.$model->business_license_img, ['width' => 100],['height'=>30]);}
//            ],
            [
                'attribute'=>'company_name',
                'options'=>['style'=>'width:150px'],
            ],
            [
                'attribute'=>'add',
                'options'=>['style'=>'width:150px'],
            ],
//             'abstract',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            [
                'attribute'=>'status',
                'options'=>['style'=>'width:80px'],
                'format'=>'html',
                'value'=>function($model){
                return EnterpriseUserAdminService::status($model->status);
            }],
            [
                'attribute'=>'status2',
                'options' => ['style' => 'width:80px'],
                'format' => 'html',
                'value'=>function($model){
              return EnterpriseUserAdminService::status2($model->status2);
            }],

            // 'level_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作',
                'headerOptions' =>['width' => '15%'],
                'template' => '{view} {update} {delete} {status}{status2}{status22}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改', $url, [
                            'title' => Yii::t('yii', '修改'),
                            'class' => '',
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', $url, [
                            'title' => Yii::t('yii', '删除'),
                            'data-confirm' => Yii::t('yii', '确定删除?'),
                            'class' => '',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', $url, [
                            'title' => Yii::t('yii', '修改密码'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'status' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-adjust"></span>', $url, [
                            'title' => Yii::t('app', 'Area'),
                        ]);
                    },
                    'status2' => function($url,$model){
                        return Html::a('通过',$url);
                    },
                    'status22' => function($url,$model){
                        return Html::a('<span class="badge bg-red">未通过</span>',$url,[
                            'title' => Yii::t('app', 'Area'),
                        ]);
                    },
                ],

            ],
        ],
    ]); ?>
</div>
<script>
    $(function(){
        alert(1111);
    });
    $(":button").click(function(){
        alert(111);
    })
</script>


