<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Classcationadmin */

$this->title = 'Create Classcationadmin';
$this->params['breadcrumbs'][] = ['label' => 'Classcationadmins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classcationadmin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list'=>$list,
    ]) ?>

</div>
