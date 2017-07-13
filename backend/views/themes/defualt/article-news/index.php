<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\service\ArticleNewsService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cateid',
            'title',
            'content:ntext',
            'thumb',
            // 'news_summary',
            // 'author',
            // 'displayorder',
            // 'is_display',
            // 'created_at',
            // 'updated_at',
            // 'click',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
