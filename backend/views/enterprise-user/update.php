<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EnterpriseUserAdmin */

$this->title = 'Update Enterprise User Admin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enterprise User Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enterprise-user-admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
