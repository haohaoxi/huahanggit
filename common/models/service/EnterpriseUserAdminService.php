<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EnterpriseUserAdmin;

/**
 * EnterpriseUserAdminService represents the model behind the search form about `common\models\EnterpriseUserAdmin`.
 */
class EnterpriseUserAdminService extends EnterpriseUserAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'status', 'status2', 'level_id', 'created_at', 'updated_at'], 'integer'],
            [['account', 'card', 'principal_idcard_img', 'principal_idcard_img2', 'business_license_num', 'business_license_img', 'company_name', 'add', 'abstract', 'auth_key', 'password_hash', 'password_reset_token'], 'safe'],
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
        $query = EnterpriseUserAdmin::find();

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
            'phone' => $this->phone,
            'status' => $this->status,
            'status2' => $this->status2,
            'level_id' => $this->level_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'card', $this->card])
            ->andFilterWhere(['like', 'principal_idcard_img', $this->principal_idcard_img])
            ->andFilterWhere(['like', 'principal_idcard_img2', $this->principal_idcard_img2])
            ->andFilterWhere(['like', 'business_license_num', $this->business_license_num])
            ->andFilterWhere(['like', 'business_license_img', $this->business_license_img])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'add', $this->add])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token]);

        return $dataProvider;
    }
    //认证状态显示

    public static  function  status2($status2){
        if($status2 ==1){
            return  "<span class='badge bg-green'>通过</span>";
        }else if($status2 == 2){
            return "<span class='badge bg-yellow'>审核中</span>";
        }else if($status2 == 3){
            return "<span class='badge bg-red'>未通过</span>";
        }

    }
    public static  function status($status){
        if($status ==1){
            return  "<span class='badge bg-green'>开启</span>";
        }else{
            return  "<span class='badge bg-red'>关闭</span>";
        }
    }


}
