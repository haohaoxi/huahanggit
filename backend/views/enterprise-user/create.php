<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EnterpriseUserAdmin */

$this->title = 'Create Enterprise User Admin';
$this->params['breadcrumbs'][] = ['label' => 'Enterprise User Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-user-admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
