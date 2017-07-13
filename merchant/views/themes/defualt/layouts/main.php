<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use merchant\assets\defualt\AppAsset;;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render('header.php') ?>
<div class="down-main">
<?= $this->render('left.php') ?>
<div class="right-product my-index right-full">
 <div class="container-fluid">
     <div class="info-center">
<?= $content ?>
     </div>
   </div>
</div>     
</div>
<?= $this->render('footer.php') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
