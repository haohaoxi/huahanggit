<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\EnterpriseUser;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "hhqy_enterprise_user".
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
class EnterpriseSignupUpdate extends ActiveRecord
{


    public static function tableName() {
        return '{{%enterprise_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'phone', 'card', 'business_license_num',
                 'company_name', 'add', 'abstract', 'password_hash', 'status2', 'level_id'], 'required'],
            [['principal_idcard_img','principal_idcard_img2','business_license_img'],'required','message'=>'图片不能为空'],
            ['principal_idcard_img', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024*1024],
            ['principal_idcard_img2', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024*1024],
            ['business_license_img', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024*1024],
//            ['verifyCode','captcha'],
//            [['phone', 'status2', 'level_id'], 'integer'],
//            [['account', 'card', 'business_license_num', 'company_name'], 'string', 'max' => 100],
//            [['principal_idcard_img', 'principal_idcard_img2', 'business_license_img', 'add', 'abstract', 'password_hash', ], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => '账号名称',
            'phone' => '企业手机号码',
            'card' => '身份证号',
            'principal_idcard_img' => '身份证正面',
            'principal_idcard_img2' => '身份证反面',
            'business_license_num' => '营业执照号',
            'business_license_img' => '营业执图片',
            'company_name' => '公司名称',
            'add' => '公司地址',
            'abstract' => '公司简介',
            'auth_key' => 'Auth Key',
            'password_hash' => '密码',
            'password_reset_token' => 'Password Reset Token',
            'status' => '状态',
            'status2' => '认证状态',
            'level_id' => '会员等级',
            'created_at' => '注册时间',
            'updated_at' => '更新时间',
        ];
    }

    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }
        $user = new EnterpriseUser();
        $user->account = $this->account;
        $user->phone = $this->phone;
        $user->card=$this->card;
        $user->principal_idcard_img=$this->principal_idcard_img;
        $user->principal_idcard_img2=$this->principal_idcard_img2;
        $user->business_license_num=$this->business_license_num;
        $user->business_license_img = $this->business_license_img;
        $user->company_name = $this->company_name;
        $user->add = $this->add;
        $user->abstract = $this->abstract;
        $user->status2 = $this->status2;
        $user->level_id = $this->level_id;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
