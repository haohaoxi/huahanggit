<<<<<<< .mine
<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%article_news}}".
 *
 * @property integer $id
 * @property integer $cateid
 * @property string $title
 * @property string $content
 * @property string $thumb
 * @property string $news_summary
 * @property string $author
 * @property integer $displayorder
 * @property integer $is_display
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $click
 */
class ArticleNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_news}}';
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
            [['cateid', 'title', ], 'required'],
            [['cateid', 'displayorder', 'is_display', ], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['thumb', 'news_summary'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cateid' => '分类id',
            'title' => '文章标题',
            'content' => '内容',
            'thumb' => '缩略图',
            'news_summary' => '简要概述',
            'author' => '作者',
            'displayorder' => '文章排序',
            'is_display' => '是否显示(1:显示2:不显示)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'click' => '点击量',
        ];
    }
}
||||||| .r155
<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%article_news}}".
 *
 * @property integer $id
 * @property integer $cateid
 * @property string $title
 * @property string $content
 * @property string $thumb
 * @property string $news_summary
 * @property string $author
 * @property integer $displayorder
 * @property integer $is_display
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $click
 */
class ArticleNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_news}}';
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
            [['cateid', 'title', ], 'required'],
            [['cateid', 'displayorder', 'is_display', ], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['thumb', 'news_summary'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cateid' => '分类id',
            'title' => '文章标题',
            'content' => '内容',
            'thumb' => '缩略图',
            'news_summary' => '简要概述',
            'author' => '作者',
            'displayorder' => '文章排序',
            'is_display' => '是否显示(1:显示2:不显示)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'click' => '点击量',
        ];
    }
}
=======
<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%article_news}}".
 *
 * @property integer $id
 * @property integer $cateid
 * @property string $title
 * @property string $content
 * @property string $thumb
 * @property string $news_summary
 * @property string $author
 * @property integer $displayorder
 * @property integer $is_display
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $click
 */
class ArticleNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_news}}';
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
            [['cateid', 'title', ], 'required'],
            [['cateid', 'displayorder', 'is_display', ], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            ['news_summary', 'string', 'max' => 255,],
            ['thumb', 'string', 'max' => 2,'on'=>['updatenoimg']],
            [['author'], 'string', 'max' => 50],
        ];
    }
    //场景设置
    public function scenarios() {
        $scenarios = parent::scenarios();

        //各个场景的活动属性  
        $scenarios['updatenoimg'] = ['cateid', 'title','content','news_summary','displayorder','is_display','author'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cateid' => '分类id',
            'title' => '文章标题',
            'content' => '内容',
            'thumb' => '缩略图',
            'news_summary' => '简要概述',
            'author' => '作者',
            'displayorder' => '文章排序',
            'is_display' => '是否显示(1:显示2:不显示)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'click' => '点击量',
        ];
    }
}
>>>>>>> .r156
