<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hhqy_demand".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $member_user_id
 * @property string $demand_price
 * @property string $demand_time
 * @property string $demand_phone
 * @property string $accessory
 * @property integer $is_secret
 * @property string $is_delete
 * @property string $created_at
 * @property string $updated_at
 */
class Demand extends \yii\db\ActiveRecord
{

    public  $list;
    public $phone;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hhqy_demand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'demand_phone','content','title','demand_price'], 'required'],
            [['member_user_id', 'demand_time', 'is_secret', 'is_delete', 'created_at', 'updated_at'], 'integer'],
            [['demand_price'], 'number'],
            [['title', 'content', 'accessory'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '需求标题',
            'content' => '具体信息',
            'member_user_id' => '用户ID',
            'demand_price' => '需求预算',
            'demand_time' => '需求有效时间',
            'demand_phone' => '联系手机号码',
            'accessory' => '附件上传',
            'is_secret' => '是否私密',
            'is_delete' => '是否删除',
            'created_at' => '需求发布时间',
            'updated_at' => '需求更改时间',
        ];
    }
}
