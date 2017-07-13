<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleNews;

/**
 * ArticleNewsService represents the model behind the search form about `common\models\ArticleNews`.
 */
class ArticleNewsService extends ArticleNews {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'cateid', 'displayorder', 'is_display', 'created_at', 'updated_at', 'click'], 'integer'],
            [['title', 'content', 'thumb', 'news_summary', 'author'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = ArticleNews::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cateid' => $this->cateid,
            'displayorder' => $this->displayorder,
            'is_display' => $this->is_display,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'click' => $this->click,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'content', $this->content])
                ->andFilterWhere(['like', 'thumb', $this->thumb])
                ->andFilterWhere(['like', 'news_summary', $this->news_summary])
                ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }

    //根据id获取文章列表
    public function getArticleList($articleCond, $pagination) {
        $query = ArticleNews::find();
        $articles = $query->orderBy('id')
                ->where($articleCond)
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        return $articles;
    }

    //获取数据表总记录数
    public function getcount() {
       // $query = ArticleNews::find();
        return ArticleNews::find()->count();
    }

}
