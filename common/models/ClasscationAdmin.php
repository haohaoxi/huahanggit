<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%classcationadmin}}".
 *
 * @property integer $id
 * @property string $categoryname
 * @property integer $sorting
 * @property string $controller
 * @property string $module
 * @property string $action
 * @property integer $praent_id
 * @property integer $is_show
 * @property integer $is_sun
 * @property string $createtime
 * @property string $updatetime
 */
class ClasscationAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%classcationadmin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryname', 'sorting', 'controller', 'module', 'action', 'is_show', 'is_sun'], 'required'],
            [['sorting', 'praent_id', 'is_show', 'is_sun'], 'integer'],
            [['createtime', 'updatetime'], 'safe'],
            [['categoryname', 'controller', 'module', 'action'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryname' => '分类名称',
            'sorting' => '排序',
            'controller' => '控制器',
            'module' => '模块',
            'action' => '方法',
            'praent_id' => '父级ID',
            'is_show' => '菜单是否显示',
            'is_sun' => '是否允许操作',
            'createtime' => '添加时间',
            'updatetime' => '修改时间',
        ];
    }


    public static function get_menus($where=['is_show'=>1]){
        $data = self::find()->orderBy('sorting asc')->where($where)->asArray()->all();
        return $data;
    }

    public static function get_status_html($status){
        if($status==1){
            echo "<font class='text-green'>启用</font>";
        }else{
            echo "<font class='text-red'>禁用</font>";
        }
    }

}
