<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\service\DemandService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Demands';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demand-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Demand', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content',
            'member_user_id',
            'demand_price',
            // 'demand_time',
            // 'demand_phone',
            // 'accessory',
            // 'is_secret',
            // 'is_delete',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
