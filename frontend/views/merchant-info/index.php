<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\service\MerchantinfoService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Merchantinfos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchantinfo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Merchantinfo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'merchant_name',
            'merchant_address_details',
            'member_id',
            'industry_type',
            // 'merchant_info_details:ntext',
            // 'principal_name',
            [
                'attribute' => 'principal_idcard_img', 'label' =>'图片', 'format' => 'raw',
                'value' => function ($model){return  Html::img($model->principal_idcard_img, ['width' => 100],['height'=>50]);},
            ],
            [
                'attribute' => 'principal_idcard_img2', 'label' =>'图片', 'format' => 'raw',
                'value' => function ($model){return  Html::img($model->principal_idcard_img2, ['width' => 100],['height'=>50]);},
            ],
            [
                'attribute' => 'business_license_img', 'label' =>'图片', 'format' => 'raw',
                'value' => function ($model){return  Html::img($model->business_license_img, ['width' => 100],['height'=>50]);},
            ],
            // 'business_license_num',,
            // 'group_id',
            // 'status',
            // 'audit_state',
            // 'audit_time:datetime',
            // 'rejected_time:datetime',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
