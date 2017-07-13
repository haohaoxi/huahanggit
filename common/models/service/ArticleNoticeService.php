<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleNotice;

/**
 * ArticleNoticeService represents the model behind the search form about `common\models\ArticleNotice`.
 */
class ArticleNoticeService extends ArticleNotice {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'cateid', 'displayorder', 'is_display',], 'integer'],
            [['title', 'thumb', 'content'], 'safe'],
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
        $query = ArticleNotice::find();

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
                ->andFilterWhere(['like', 'thumb', $this->thumb])
                ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }

}
