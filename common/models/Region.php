<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $code
 * @property integer $parentCode
 * @property integer $type
 * @property string $name
 * @property string $fullName
 */
class Region extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['code', 'parentCode', 'type', 'name', 'fullName'], 'required'],
            [['code', 'parentCode', 'type'], 'integer'],
            [['name', 'fullName'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'code' => '地区id',
            'parentCode' => '父id',
            'type' => '省市区层级',
            'name' => 'Name',
            'fullName' => '地区全名',
        ];
    }

}
