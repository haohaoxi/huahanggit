<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MemberUser */

$this->title = 'Create Member User';
$this->params['breadcrumbs'][] = ['label' => 'Member Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
