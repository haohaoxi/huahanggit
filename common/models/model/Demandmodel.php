<?php

namespace common\models\model;

use Yii;
use yii\web\UploadedFile;
use common\models\EnterpriseUser;
use common\models\Category;

class Demandmodel
{

 //需求展示分类信息
public  function classification($id){
    $uid = "<tr>您选择的分类：";
    while ($id!=0){

        $priseid = Category::find()->select(['id','pid','category_name'])->where(['id'=>$id])->asArray()->one();

        $uid  .= "<td>".$priseid['category_name']."--</td>";
        $id = $priseid['pid'];


    }
    $uid .="</tr>";
   return   substr($uid,0,-12);
}

public  function denadnlist($id){

    $subid=[];
    while ($id!=0) {
        $pidarray= Category::find()->where(['id'=>$id])->asArray()->one();
        $subid[]=$pidarray["id"];
        $id=$pidarray["pid"];
    }
    return $subid;

}







}





?>