<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $category_name
 * @property string $category_describe
 * @property integer $sort
s
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sorts', 'status', 'created_at', 'updated_at'], 'integer'],
            [['category_name', 'category_describe', 'created_at', 'updated_at'], 'required'],
            [['category_name'], 'string', 'max' => 128],
            [['category_describe'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'category_name' => 'Category Name',
            'category_describe' => 'Category Describe',
            'sorts' => 'SortS',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
