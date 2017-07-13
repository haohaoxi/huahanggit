<?php

namespace common\models\model;

use Yii;
use yii\web\UploadedFile;
use common\models\EnterpriseUser;
use common\models\Category;

class Enterprisemodel
{
        //审核调用方法
  public static  function audit_state($userid,$b){
      $status = EnterpriseUser::find()->select('status2')->where(['id'=>$userid])->all();
        if(!empty($status[0]->status2) && !empty($b)){
            if($b == 1){
                switch ($status[0]->status2){
                    case 1;
                        return "<a href='/index.php?=enterprise/index'>审核通过</a>";
                        break;
                    case 2;
                        return "审核中";
                        break;
                    case 3;
                        return "<a href='/index.php?r=enterprise/updateuser&id=$userid'>未通过</a>";
                        break;
                    default;
                        return "参数错误请检查";
                }
            }elseif($b ==2){
                echo "后端调用";
            }
        }else{
            echo "参数错误";exit;
        }
    }

//

    //图片放入文件夹  和返回图片路径名称
    public function uploads($model,$image,$img){
        $lujing  =  substr($_SERVER['CONTEXT_DOCUMENT_ROOT'],0,strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])-12);
        foreach($image as $key=>$vo){
            $upload = $this->uploadedFile($model,$vo);
            $model->$vo = 'uploads/'.$img . date('YmdHis').$key . $upload;
            $name = iconv('utf-8','gb2312' ,$upload->name);
            $upload->saveAs($lujing.'/frontend/web'.'/uploads/'.$img     . date('YmdHis').$key . $name);
            $models[] = $model->$vo;
        }
        return $models;
    }
    //上传图片控件
    public function uploadedFile($model, $item)
    {
//        $upload = UploadedFile::getInstance($model, $item);
//        return $upload;
        if(!UploadedFile::getInstance($model, $item) == null){
            $upload = UploadedFile::getInstance($model, $item);
            return $upload;
        }else{
            echo "<script>alert('图片不能为空'),window.history.back(-1)</script>";
            exit;
        }
    }

    //获取分类结构方法

    //  $list 数组
    function make_tree($list,$pk='id',$pid='pid',$child='_child',$root=0){
        $tree=array();
        $packData=array();
        foreach ($list as  $data) {
            $packData[$data[$pk]] = $data;
        }

        foreach ($packData as $key =>$val){
            if($val[$pid]==$root){//代表跟节点
                $tree[] = &$packData[$key];
            }else{
                //找到其父类
                $packData[$val[$pid]][$child][]=& $packData[$key];

            }

        }

        return $tree;

    }
    function get1($id){
        return  Category::find()->select(['id','pid','category_name'])->where(['pid'=>$id])->asArray()->all();

    }
//获取当前顶级分类下的二级三级分类

    public  function lists($id){
        $list = Category::find()->select(['id','pid','category_name'])->where(['pid'=>$id])->asArray()->all();

            foreach ($list as $key=>$vo){

                $vo['tree']  = self::get1($vo['id']);
                $pach[] = $vo;
            }
                $html = '';
                foreach ($pach as $key=>$vo1){
                $html .="<div class='right-container'><div class='title'><p>".$vo1['category_name']."</p>";
                if(!empty($vo1['tree'])){
                    for ($i=0;$i<count($vo1['tree']);$i++){
                            $id  = $vo1['tree'][$i]['id'];
                       $html .=  "<li><input type='hidden' value='$id' >".$vo1['tree'][$i]['category_name']."</li>";
                    }
                }

                $html .= "</div></div>";
            }
            return $html;
        }




















}


















?>