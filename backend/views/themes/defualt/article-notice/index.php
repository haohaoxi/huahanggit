<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\service\ArticleNoticeService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article Notices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-notice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article Notice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cateid',
            'title',
            'thumb',
            'content:ntext',
            // 'displayorder',
            // 'is_display',
            // 'createtime:datetime',
            // 'click',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
