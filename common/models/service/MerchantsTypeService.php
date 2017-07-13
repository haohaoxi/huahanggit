<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MerchantsType;

/**
 * MerchantsTypeService represents the model behind the search form about `common\models\MerchantsType`.
 */
class MerchantsTypeService extends MerchantsType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid', 'sorts', 'status', 'created_at', 'updated_at'], 'integer'],
            [['type_name', 'type_describe'], 'safe'],
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
        $query = MerchantsType::find();

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
            'pid' => $this->pid,
            'sorts' => $this->sorts,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type_name', $this->type_name])
            ->andFilterWhere(['like', 'type_describe', $this->type_describe]);

        return $dataProvider;
    }
}
