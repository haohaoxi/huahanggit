<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "merchant_info".
 *
 * @property string $id
 * @property string $merchant_name
 * @property string $merchant_address_details
 * @property integer $member_id
 * @property string $industry_type
 * @property string $merchant_info_details
 * @property string $principal_name
 * @property string $principal_idcard_img
 * @property string $principal_idcard_img2
 * @property string $business_license_num
 * @property string $business_license_img
 * @property string $group_id
 * @property integer $status
 * @property integer $audit_state
 * @property integer $audit_time
 * @property integer $rejected_time
 * @property integer $created_at
 * @property integer $updated_at
 */
class MerchantInfo extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%merchant_info}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

//    public function behaviors() {
//
//        return [
//            [
//                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'create_time', // 自己根据数据库字段修改
//                'updatedAtAttribute' => 'update_time', // 自己根据数据库字段修改
//                'value' => time(), // 自己根据数据库字段修改
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['merchant_name', 'merchant_address_details','group_id'], 'required','message'=>"不能为空"],
            [['member_id', 'group_id', 'status', 'audit_state', 'audit_time', 'rejected_time'], 'integer'],
            ['rejected_time', 'default', 'value' => time()],
            [['merchant_info_details'], 'string'],
<<<<<<< .mine
            [['principal_idcard_img','principal_idcard_img2','business_license_img'],'required','message'=>'图片不能为空'],
||||||| .r116
//            ['principal_idcard_img','file', 'skipOnEmpty' => false,'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
=======
            ['principal_idcard_img','file', 'skipOnEmpty' => false,'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
>>>>>>> .r155
            [['merchant_name', 'merchant_address_details',  'principal_idcard_img2', 'business_license_img'], 'string', 'max' => 255],
            [['industry_type'], 'string', 'max' => 128],
            [['principal_name'], 'string', 'max' => 120],
            [['business_license_num'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        $scenarios = parent::scenarios(); //本行必填，不写的话就会报如上错误
        $scenarios['create'] = ['merchant_name','industry_type','merchant_address_details','member_id','group_id','merchant_info_details','principal_name','principal_idcard_img','principal_idcard_img2','business_license_img','business_license_num','audit_time','rejected_time'];
        $scenarios['update'] = ['merchant_name','industry_type','merchant_info_details','principal_name','merchant_address_details','group_id','rejected_time'];
        $scenarios['backendupdate'] = ['merchant_name','merchant_address_details','merchant_info_details','principal_name','merchant_name','audit_state'];
        $scenarios['frontendupdate'] = ['merchant_name','merchant_address_details','merchant_info_details','principal_name','principal_idcard_img','principal_idcard_img2','business_license_img','merchant_name'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'merchant_name' => '名称',
            'merchant_address_details' => '地址详情',
            'member_id' => '会员ID',
            'industry_type' => '行业类型',
            'merchant_info_details' => '详细信息',
            'principal_name' => '负责人姓名',
            'principal_idcard_img' => '负责人身份证正面',
            'principal_idcard_img2' => '负责人身份证反面',
            'business_license_num' => '营业执照注册号',
            'business_license_img' => '营业执照注册图片',
            'group_id' => '分级id',
            'status' => '账号状态',
            'audit_state' => '审核状态',
            'audit_time' => '审核时间',
            'rejected_time' => '驳回时间',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

}
