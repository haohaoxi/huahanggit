<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MerchantInfo */

$this->title = 'Create Merchant Info';
$this->params['breadcrumbs'][] = ['label' => 'Merchant Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
