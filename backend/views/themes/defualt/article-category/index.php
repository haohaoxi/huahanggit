<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\service\ArticleCategoryService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Article Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Article Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php //Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pid',
            'title',
            'displayorder',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\service\ArticleCategoryService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Article Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Article Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php //Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pid',
            'title',
            'displayorder',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
 use leandrogehlen\treegrid\TreeGrid;
/* @var $this yii\web\View */
/* @var $searchModel common\models\service\ArticleCategoryService */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Article Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Article Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php //Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pid',
            'title',
            'displayorder',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php //Pjax::end(); ?></div>
  <?= TreeGrid::widget([
      'dataProvider' =>   $dataProviderTable,
      'keyColumnName' => 'id',
      'parentColumnName' => 'pid',
      'columns' => [
          'title',
          'type',
          'displayorder',
          ['class' => 'yii\grid\ActionColumn']
      ]        
  ]); ?> 