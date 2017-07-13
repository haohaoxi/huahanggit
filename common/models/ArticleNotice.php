<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article_notice}}".
 *
 * @property integer $id
 * @property integer $cateid
 * @property string $title
 * @property string $thumb
 * @property string $content
 * @property integer $displayorder
 * @property integer $is_display
 * @property integer $createtime
 * @property integer $click
 */
class ArticleNotice extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%article_notice}}';
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
    public function rules() {
        return [
            [['cateid', 'title', 'content',], 'required'],
            [['cateid', 'displayorder', 'is_display',], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            ['thumb', 'string', 'max' => 255,'on'=>['updatenoimg']],
        ];
    }
    //场景设置
    public function scenarios() {
        $scenarios = parent::scenarios();

        //各个场景的活动属性  
        $scenarios['updatenoimg'] = ['cateid', 'title','content','displayorder','is_display'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'cateid' => '分类id',
            'title' => '标题',
            'thumb' => 'Thumb',
            'content' => '内容',
            'displayorder' => '显示顺序',
            'is_display' => '是否显示（1：显示2：不显示）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'click' => '阅读次数',
        ];
    }

}
