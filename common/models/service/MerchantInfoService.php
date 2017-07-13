<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MerchantInfo;
use yii\web\UploadedFile;

/**
 * MerchantinfoService represents the model behind the search form about `common\models\Merchantinfo`.
 */
class MerchantInfoService extends MerchantInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'group_id', 'status', 'audit_state', 'audit_time', 'rejected_time', 'created_at', 'updated_at'], 'integer'],
            [['merchant_name', 'merchant_address_details', 'industry_type', 'merchant_info_details', 'principal_name', 'principal_idcard_img', 'principal_idcard_img2', 'business_license_num', 'business_license_img'], 'safe'],
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
        $query = Merchantinfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'pagination' => [
                'pageSize' => 5,
            ],
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
            'member_id' => $this->member_id,
            'group_id' => $this->group_id,
            'status' => $this->status,
            'audit_state' => $this->audit_state,
            'audit_time' => $this->audit_time,
            'rejected_time' => $this->rejected_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'merchant_address_details', $this->merchant_address_details])
            ->andFilterWhere(['like', 'industry_type', $this->industry_type])
            ->andFilterWhere(['like', 'merchant_info_details', $this->merchant_info_details])
            ->andFilterWhere(['like', 'principal_name', $this->principal_name])
            ->andFilterWhere(['like', 'principal_idcard_img', $this->principal_idcard_img])
            ->andFilterWhere(['like', 'principal_idcard_img2', $this->principal_idcard_img2])
            ->andFilterWhere(['like', 'business_license_num', $this->business_license_num])
            ->andFilterWhere(['like', 'business_license_img', $this->business_license_img]);

        return $dataProvider;
    }

	  public function uploads($model,$image,$img){
        $lujing  =  substr($_SERVER['CONTEXT_DOCUMENT_ROOT'],0,strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])-12);
        foreach($image as $key=>$vo){
            $upload = $this->uploadedFile($model,$vo);
            $model->$vo = 'uploads/'.$img . date('YmdHis').$key . $upload;
            $upload->saveAs($lujing.'/frontend/web'.'/uploads/'.$img     . date('YmdHis').$key . $upload->name);
            $models[] = $model->$vo;
        }
        return $models;
    }
    //上传图片控件
    public function uploadedFile($model, $item)
    {
        $upload = UploadedFile::getInstance($model, $item);
                return $upload;
//        if(){
//
//        }else{
//            echo "<script>alert('图片不能为空'),window.history.back(-1)</script>";
//            exit;
//        }
    }
//后端x显示状态显示
    public function  status($data){
        if($data == 1){return "正常";}return "关闭";}

    //后端审核状态显示
    public function audit_state($data){
        switch ($data)
        {
            case 1;
            return "审核中";
            break;
            case 2;
            return "未通过";
            break;
            case 3;
            return "通过";
            break;
            case 4;
            return "待完善";
            default:
            return "参数错误";

<<<<<<< .mine
        $merchanid = MerchantInfo::find()->select('id')->where(['member_id'=>Yii::$app->user->id])->one();
        if($status == 1){
            switch ($data)
            {
                case 1;
                    return    "审核中";
                    break;
                case 2;
                    return    "未通过";
                    break;
                case 3;
                    return    "通过";
                    break;
                case 4;
                    return    "待完善";
                    break;
                default:
                    return    "参数错误";

            }
        }elseif($status == 2){
            switch ($data)
            {
                case 1;
                    echo   "<font class='text-green'>审核中</font>";
                    break;
                case 2;
                    echo "<font class='text-green'><a href='/index.php?r=merchant-info/update&id=$merchanid->id'>请重新提交审核资料</a></font>";
                    break;
                case 3;
                    echo "<font class='text-green'><a href='/index.php?r=merchant-info/enterprise'>已通过,欢迎使用此平台</a></font>";
                    break;
                case 4;
                    echo "<font class='text-green'>待完善</font>";
                    break;
                default:
                    echo "<font class='text-green'>参数错误</font>";

            }
||||||| .r116
        $merchanid = MerchantInfo::find()->select('id')->where(['member_id'=>Yii::$app->user->id])->one();
        if($status == 1){
            switch ($data)
            {
                case 1;
                    return    "审核中";
                    break;
                case 2;
                    return    "未通过";
                    break;
                case 3;
                    return    "已通过";
                    break;
                case 4;
                    return    "待完善";
                    break;
                default:
                    return    "参数错误";

            }
        }elseif($status == 2){
            switch ($data)
            {
                case 1;
                    echo   "<font class='text-green'>审核中</font>";
                    break;
                case 2;
                    echo "<font class='text-green'><a href='/index.php?r=merchant-info/update&id=$merchanid->id'>请重新提交审核资料</a></font>";
                    break;
                case 3;
                    echo "<font class='text-green'><a href='/index.php?r=merchant-info/enterprise'>已通过,欢迎使用此平台</a></font>";
                    break;
                case 4;
                    echo "<font class='text-green'>待完善</font>";
                    break;
                default:
                    echo "<font class='text-green'>参数错误</font>";

            }
=======
>>>>>>> .r155
        }

    }

}
