<?php

use yii\helpers\Html;

/* @var $this  yii\web\View */
/* @var $model backend\models\BizRule */

$this->title = Yii::t('rbac-admin', 'Create Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <hr/>

    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
