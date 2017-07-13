<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%article_category}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $title
 * @property integer $displayorder
 * @property string $type
 */
class ArticleCategory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%article_category}}';
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
            [['pid', 'displayorder'], 'integer','on'=>['register','update']],
            [['title', 'displayorder', 'type'], 'required','on'=>['register','update']],
            [['title'], 'string', 'max' => 30],
            [['type'], 'string', 'max' => 2,'on'=>['register','update']],
        ];
    }
    //场景设置
    public function scenarios() {
        $scenarios = parent::scenarios();

        //各个场景的活动属性  
        $scenarios['register'] = ['pid', 'title', 'type','displayorder'];
        $scenarios['update'] = ['pid', 'title','displayorder','type'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'pid' => '父id',
            'title' => '栏目标题',
            'displayorder' => '显示顺序',
            'type' => '类型（1.普通文章2.新闻3.系统通知4.系统公告）',
        ];
    }

}
