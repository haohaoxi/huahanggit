<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\MerchantInfo;

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

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '首页',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
//    if(Yii::$app->user->isGuest){
//        $menuItems = [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => '加盟中心', 'url' => ['/merchant-info/create']],
//        ];
//    }else{
//        $model = MerchantInfo::find()->where(['member_id' => Yii::$app->user->id])->asArray()->all();
//        if(!empty($model)){
//            if($model[0]['audit_state'] != 3){
//                $menuItems = [
//                    ['label' => 'Home', 'url' => ['/site/index']],
//                    ['label' => '我的企业', 'url' => ['/merchant-info/audit']],
//                ];
//            }else{
//                $menuItems = [
//                    ['label' => 'Home', 'url' => ['/site/index']],
//                    ['label' => '我的企业', 'url' => ['/merchant-info/enterprise']],
//                ];
//            }
//
//        }else{
//            $menuItems = [
//                ['label' => 'Home', 'url' => ['/site/index']],
//                ['label' => '加盟中心', 'url' => ['/merchant-info/create']],
//            ];
//        }
//
//    }

    $menuItems = [
        ['label' => '企业中心', 'url' => ['/enterprise/audit']],
//        ['label' => '个人中心', 'url' => ['/enterprise/personal']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '注册', 'url' => ['/enterprise/signup']];
        $menuItems[] = ['label' => '登录', 'url' => ['/enterprise/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/enterprise/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->account . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
