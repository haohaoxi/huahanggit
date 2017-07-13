<?php
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\service\MerchantInfoService;
use backend\assets\AppAsset;
?>
<?php AppAsset::register($this);?>
<h1>审核状态;<?= MerchantInfoService::audit_state($data,$id = 2) ;?></h1>