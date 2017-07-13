<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\defualt\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

//use yii\helpers\Url;

AppAsset::register($this);
$cssString = ".content-wrapper{padding:5px 10px}";  
$this->registerCss($cssString);
//$this->registerCssFile('@web/css/font-awesome.min.css',['depends'=>['api\assets\AppAsset']]);  
//$this->registerJsFile('@web/js/jquery-ui.custom.min.js',['depends'=>['api\assets\AppAsset']]); 
?>
<?php $this->beginBlock("uibutton") ?>
$.widget.bridge('uibutton', $.ui.button);
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["uibutton"], \yii\web\View::POS_END); ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php $this->beginBody() ?>
            <?= $this->render('header.php') ?>
            <?= $this->render('left.php') ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" >
                <section class="content-header">
                    <?php if (isset($this->blocks['content-header'])) { ?>
                        <h1><?= $this->blocks['content-header'] ?><small>Control panel</small></h1>
                    <?php } else { ?>
                        <h1>
                            <?php
                            if ($this->title !== null) {
                                echo \yii\helpers\Html::encode($this->title).'<small>Control panel</small>';
                            } else {
                                echo \yii\helpers\Inflector::camel2words(
                                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                                );
                                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                            }
                            ?>
                        </h1>
                    <?php } ?>
                    <?=
                    Breadcrumbs::widget(
                            [
                                'encodeLabels' => false,
                                'homeLink' => [
                                    'label' => "<i class='fa fa-dashboard'></i>" . Yii::t('yii', 'Home'),
                                    'url' => Yii::$app->homeUrl,
                                    'template' => '<li>{link}</li>',
                                ],
                                'activeItemTemplate' => "<li class=\"active\">{link}</li>\n",
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]
                    )
                    ?>
                </section>
                
                <?= $content ?>
            </div>
            <!-- /.content-wrapper -->   
            <?= $this->render('footer.php') ?>
            <?php $this->endBody() ?>
        </div>
    </body>
</html>
<?php $this->endPage() ?>