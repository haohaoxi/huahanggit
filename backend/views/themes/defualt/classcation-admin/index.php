<?php
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ClasscationAdmin;
use backend\assets\AppAsset;
?>


<style>
    .default-table tr th {
        height: 38px;
        background: #ecf1f7;
        font-size: 14px;
        font-weight: normal;
    }
</style>

<?php AppAsset::register($this);?>
<div class="boxer">
    <a href="<?= Yii::$app->urlManager->createUrl(['classcationadmin/create']) ?>" class="roles-search">新增菜单</a>
    <br class="clr">

    <div class="default-table">
<!--        <img src="http://huhang.com/backend/views/classcationadmin/timg.jpg" width="165" height="60" />-->
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tbody>
            <tr>
                <th width="5%">单选</th>
                <th width="20%">菜单名称</th>
                <th width="10%">控制器</th>
                <th width="10%">模块</th>
                <th width="10%">方法</th>
<!--                <th width="10%">排序</th>-->
                <th width="10%">菜单是否显示</th>
                <th width="10%">是否允许操作</th>
                <th width="20%">操作</th>
            </tr>
            <?php
            if(count($data) >0 ){
                foreach($data as $key=>$value){
                    ?>
                    <tr>
                        <td><input type="checkbox" name="id" value="<?= $value['id']?>"></td>
                        <td style="text-align: left"><?= $value['fullname']; ?></td>
                        <td><?= $value['controller']; ?></td>
                        <td><?= $value['module']; ?></td>
                        <td><?= $value['action']; ?></td>
<!--                        <td>--><?//= $value['sorting']; ?><!--</td>-->
                        <td><?= ClasscationAdmin::get_status_html($value['is_show']); ?></td>
                         <td><?= ClasscationAdmin::get_status_html($value['is_sun']); ?></td>
                        <td>
                           <a href="<?= Yii::$app->urlManager->createUrl(['classcation-admin/update','id'=>$value['id']]) ?>" class="">编辑</a>&nbsp;&nbsp;
                            <a onclick="return confirm('是否确认删除？');" href="<?= Yii::$app->urlManager->createUrl(['classcation-admin/delete','id'=>$value['id']]) ?>" class="">删除</a>&nbsp;&nbsp;
                        </td>
                    </tr>
                <?php }} ?>
            <input type="button" id="button1" onclick="alertMsg()"
                   value="Button1" />
            </tbody>
        </table>
    </div>
</div>
<?php $this->beginBlock("button1") ?>
<script>
$("#button1").click(function(){
    alert(11111111);
});
</script>
$.widget.bridge('uibutton', $.ui.button);
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["button1"], \yii\web\View::POS_END); ?>
