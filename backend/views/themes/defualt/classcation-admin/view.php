<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Classcationadmin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Classcationadmins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classcationadmin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('index', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'categoryname',
            'sorting',
            'controller',
            'module',
            'action',
            'praent_id',
            'is_show',
            'is_sun',
            'createtime',
            'updatetime',
        ],
    ]) ?>

</div>
