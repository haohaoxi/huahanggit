<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DemandExtend;

/**
 * DemandExtendService represents the model behind the search form about `common\models\DemandExtend`.
 */
class DemandExtendService extends DemandExtend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'demand_id', 'category_id_1', 'category_id_2', 'category_id_3', 'category_id_4', 'category_id_5', 'category_id_6', 'province_id', 'city_id', 'area_id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
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
        $query = DemandExtend::find();

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
            'demand_id' => $this->demand_id,
            'category_id_1' => $this->category_id_1,
            'category_id_2' => $this->category_id_2,
            'category_id_3' => $this->category_id_3,
            'category_id_4' => $this->category_id_4,
            'category_id_5' => $this->category_id_5,
            'category_id_6' => $this->category_id_6,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'price' => $this->price,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
