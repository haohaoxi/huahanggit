<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%enterprise_user}}".
 *
 * @property string $id
 * @property string $account
 * @property string $phone
 * @property string $card
 * @property string $principal_idcard_img
 * @property string $principal_idcard_img2
 * @property string $business_license_num
 * @property string $business_license_img
 * @property string $company_name
 * @property string $add
 * @property string $abstract
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $status2
 * @property integer $level_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class EnterpriseUserAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%enterprise_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'phone', 'card', 'principal_idcard_img', 'principal_idcard_img2', 'business_license_num', 'business_license_img', 'company_name', 'add', 'abstract', 'auth_key', 'password_hash', 'status', 'status2', 'level_id', 'created_at', 'updated_at'], 'required'],
            [['phone', 'status', 'status2', 'level_id', 'created_at', 'updated_at'], 'integer'],
            [['account', 'card', 'business_license_num', 'company_name'], 'string', 'max' => 100],
            [['principal_idcard_img', 'principal_idcard_img2', 'business_license_img', 'add', 'abstract', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => '账户名称',
            'phone' => '手机号码',
            'card' => '身份证号',
            'principal_idcard_img' => '身份证正面',
            'principal_idcard_img2' => '身份证反面',
            'business_license_num' => '营业执照号',
            'business_license_img' => '营业执照图片',
            'company_name' => '商家名称',
            'add' => '商家地址',
            'abstract' => '简介',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => '状态',
            'status2' => '认证状态',
            'level_id' => '会员等级',
            'created_at' => '注册时间',
            'updated_at' => '更新时间',
        ];
    }
}
