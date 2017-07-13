<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%merchants_type}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $type_name
 * @property string $type_describe
 * @property integer $sorts
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class MerchantsType extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchants_type}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sorts', 'status', ], 'integer'],
            [['type_name', 'type_describe',], 'required'],
            [['type_name'], 'string', 'max' => 128],
            [['type_describe'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '分类id',
            'pid' => '父id',
            'type_name' => '类型名称',
            'type_describe' => '类型描述',
            'sorts' => '排序',
            'status' => '状态（1：正常2：关闭）',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }


}
