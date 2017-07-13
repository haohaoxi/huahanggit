<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Merchantinfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Merchantinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchantinfo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'merchant_name',
            'merchant_address_details',
            'member_id',
            'industry_type',
            'merchant_info_details:ntext',
            'principal_name',
            'principal_idcard_img',
            'principal_idcard_img2',
            'business_license_num',
            'business_license_img',
            'group_id',
            'status',
            'audit_state',
            'audit_time:datetime',
            'rejected_time:datetime',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
