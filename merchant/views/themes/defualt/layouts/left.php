<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */
?>
  <div class="left-main left-full">
    <div class="sidebar-fold"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
    <div class="subNavBox">
      <div class="sBox">
       <div class="subNav sublist-down"><span class="title-icon glyphicon glyphicon-chevron-down"></span><span class="sublist-title">用户中心</span>
        </div>
        <ul class="navContent" style="display:block">
          <li <?php if($this->context->action->id=="test"){echo 'class="active"';}?>>
            <div class="showtitle" style="width:100px;"><img src="<?= Url::to('@web/themes/defualt/img/leftimg.png'); ?>" />账号管理</div>
            <?=Html::a('<span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">账号管理</span>', ['admin/user-info'])?></li>
          <li <?php if($this->context->action->id=="test1"){echo 'class="active"';}?>>
            <div class="showtitle" style="width:100px;"><img src="<?= Url::to('@web/themes/defualt/img/leftimg.png'); ?>" />消息中心</div>
          <?=Html::a('<span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">消息中心</span>', ['admin/logout'])?></li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="<?= Url::to('@web/themes/defualt/img/leftimg.png'); ?>" />商户管理</div>
          <?=Html::a('<span class="sublist-icon glyphicon glyphicon-bullhorn"></span><span class="sub-title">商户管理</span>', ['merchant-info/index'])?></li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="<?= Url::to('@web/themes/defualt/img/leftimg.png'); ?>" />实名认证</div>
            <?=Html::a('<span class="sublist-icon glyphicon glyphicon-credit-card"></span><span class="sub-title">实名认证</span>', ['admin/identify'])?></li>
        </ul>
      </div>
      <div class="sBox">
        <div class="subNav <?php if($this->context->id=="site"){echo 'active';}?> sublist-up"><span class="title-icon glyphicon glyphicon-chevron-up"></span><span class="sublist-title">关于我们</span></div>
        <ul class="navContent" >
          <li>
            <div class="showtitle" style="width:100px;"><img src="<?= Url::to('@web/themes/defualt/img/leftimg.png'); ?>" />新闻管理</div>
            <?=Html::a('<span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">新闻管理</span>', ['news/index'])?></li>
	      <li>
            <div class="showtitle" style="width:100px;"><img src="<?= Url::to('@web/themes/defualt/img/leftimg.png'); ?>" />自动生成</div>
            <?=Html::a('<span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">自动生成</span>', ['gii/default'])?></li>
        </ul>
      </div>
    </div>
  </div>
