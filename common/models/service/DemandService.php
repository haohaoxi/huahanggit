<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Demand;

/**
 * DemandService represents the model behind the search form about `common\models\Demand`.
 */
class DemandService extends Demand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'member_user_id', 'demand_time', 'demand_phone', 'is_secret', 'is_delete', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'accessory'], 'safe'],
            [['demand_price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Demand::find();

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
            'member_user_id' => $this->member_user_id,
            'demand_price' => $this->demand_price,
            'demand_time' => $this->demand_time,
            'demand_phone' => $this->demand_phone,
            'is_secret' => $this->is_secret,
            'is_delete' => $this->is_delete,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'accessory', $this->accessory]);

        return $dataProvider;
    }
}