<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MerchantInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Merchant Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            'id',
            'merchant_name',
            'merchant_address_details',
            'member_id',
            'industry_type',
            'merchant_info_details:ntext',
            'principal_name',
            [
                'attribute' => 'principal_idcard_img',
                'label' => '身份证照片',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::img($model->principal_idcard_img,['width'=>'40','height'=>'30','alt'=>"身份证照片"]);
                }
            ],
            'principal_idcard_img2',
            'business_license_num',
            'business_license_img',
            'group_id',
            'status',
            'audit_state',
            'audit_time:datetime',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('Y-m-d H:i:s ', $model->created_at);
                }],
            // 'created_at:datetime',
            'updated_at:date',
        ],
    ])
    ?>

</div>
