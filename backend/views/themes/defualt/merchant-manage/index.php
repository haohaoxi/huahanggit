<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\service\MerchantInfoService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Merchant Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Merchant Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
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
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
