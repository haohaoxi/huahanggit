<?php
namespace merchant\models;
use Yii;
use yii\base\Model;
use common\models\MerchantInfo;

/**
 * Signup form
 */
class MerchantInfoForm extends Model
{
public  $merchant_name;
public  $merchant_address_details;
public $member_id;
public  $industry_type;
public  $merchant_info_details;
public  $principal_name;
public  $principal_idcard_img;
public  $principal_idcard_img2;
public  $business_license_num;
public  $business_license_img;
public $group_id;
public $status;
public $audit_state;
public $audit_time;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_name', 'merchant_address_details'], 'required'],
            [['member_id', 'group_id', 'status', 'audit_state', 'audit_time'], 'integer'],
            [['merchant_info_details'], 'string'],
            [['merchant_name', 'merchant_address_details', 'principal_idcard_img', 'principal_idcard_img2', 'business_license_img'], 'string', 'max' => 255],
            [['industry_type'], 'string', 'max' => 128],
            [['principal_name'], 'string', 'max' => 100],
            [['business_license_num'], 'string', 'max' => 32],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate()) {
			
             $merchantInfo = new MerchantInfo();
            $merchantInfo->merchant_name=$this->merchant_name;
			$merchantInfo->merchant_address_details=$this->merchant_address_details;
			$merchantInfo->member_id=$this->member_id;
			$merchantInfo->industry_type=$this->industry_type;
			$merchantInfo->merchant_info_details=$this->merchant_info_details;
			$merchantInfo->principal_name=$this->principal_name;
			$merchantInfo->principal_idcard_img=$this->principal_idcard_img;
			$merchantInfo->principal_idcard_img2=$this->principal_idcard_img2;
			$merchantInfo->business_license_num=$this->business_license_num;
			$merchantInfo->business_license_img=$this->business_license_img;
			$merchantInfo->group_id=$this->group_id;
			$merchantInfo->status=$this->status;
			$merchantInfo->audit_state=$this->audit_state;
			$merchantInfo->audit_time=$this->audit_time;
            if ($merchantInfo->save()) {
				
                return $merchantInfo;
            }
        } else {
            return false;
        }
    }
}
