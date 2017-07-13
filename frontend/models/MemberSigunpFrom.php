<?php

namespace frontend\models;

use common\models\MemberUser;

//extends ActiveRecord implements IdentityInterface

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $account
 * @property string $name
 * @property string $passwd
 * @property integer $level_id
 * @property string $telnum
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class MemberSigunpFrom extends MemberUser
{

    public $account;
    public $name;
    public $passwd;
    public $telnum;
    public $email;
    public $level_id;

    /**
     * @inheritdoc
     */
//    public static function tableName()
//    {
//        return 'member';
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account'], 'required','message' => '用户名不能为空'],
            ['account','match','pattern'=>'/^[a-zA-Z0-9\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/','message'=>'请输入正确的{attribute}'],
            [['name'], 'required','message' => '会员名称不能为空'],
            [['passwd'], 'required','message' => '密码不能为空'],
            [['telnum'], 'required','message' => '手机号码不能为空'],
            [['email'], 'required','message' => '邮箱不能为空'],
            ['account', 'unique','message' => '用户名以被使用'],
            [['account'], 'string', 'max' => 68],
            [['name'], 'string', 'max' => 128],
            [['passwd'], 'string', 'max' => 64],
            [['telnum'], 'string', 'max' => 11],
            ['telnum','match','pattern'=>'/^1[34578]\d{9}$/','message'=>'请输入正确的{attribute}'],
            ['telnum', 'unique', 'message' => '手机号码已被注册'],
            [['email'], 'string', 'max' => 255],
            ['email','email','message'=>'邮箱格式错误'],
            ['email', 'unique','message'=>'邮箱已被使用'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => '账号',
            'name' => '用户名',
            'passwd' => '密码',
            'level_id' => 'Level ID',
            'telnum' => '手机号码',
            'email' => '邮箱',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }
            $user = new MemberUser();
            $user->account = $this->account;
            $user->name = $this->name;
            $user->telnum=$this->telnum;//手机号
            $user->email=$this->email;
            $user->level_id=$this->level_id;
            $user->passwd = $this->passwd;
            $user->passwd = $this->passwd;
            $user->setPassword($this->passwd);
            $user->generateAuthKey();
             return $user->save() ? $user : null;
    }
}
