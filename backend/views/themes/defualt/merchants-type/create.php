<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MerchantsType */

$this->title = Yii::t('app', 'Create Merchants Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchants-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
