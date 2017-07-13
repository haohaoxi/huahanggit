<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\EnterpriseUser;
/**
 * Login form
 */
class EnterprisePasswordForm extends Model
{
    public $password_hash;
    public $password;
    public $reppassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
//            [['username', 'password'], 'required',],
            [['password_hash', 'password','reppassword'], 'required',],
//            [['password_hash'],'validatePassword'],
            [['password','reppassword'], 'required'],
            [['password','reppassword'], 'string', 'min' => 6],
            ['reppassword', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！'],

        ];
    }

//    public function validatePassword($attribute, $params)
//    {
//        if(!Yii::$app->security->validatePassword($this->oldpwd, Yii::$app->user->identity->password_hash)){
//            $this->addError($attribute, "旧密码错误111.");
//            return false;
//        }
//        return true;
//    }




}
