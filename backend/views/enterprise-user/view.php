<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EnterpriseUserAdmin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enterprise User Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-user-admin-view">

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
            'account',
            'phone',
            'card',
            'principal_idcard_img',
            'principal_idcard_img2',
            'business_license_num',
            'business_license_img',
            'company_name',
            'add',
            'abstract',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'status',
            'status2',
            'level_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
