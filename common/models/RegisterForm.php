<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Admin;
/**
 * Login form
 */
class RegisterForm extends Model
{
    public $username;
	public $email;
	public $password;
	public $repassword;
    public $rememberMe = true;

    private $_admin;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
		    ['username', 'filter', 'filter' => 'trim'],
            // username and password are both required
            [['username','email','repassword'], 'required'],
			['username', 'string', 'min' => 2, 'max' => 255],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword
			['username', 'validateUser'],
           // ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->repassword!=$this->password) {
                $this->addError($attribute, 'Incorrect password or repassword.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate()) {
			
            $user = new Admin();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function validateUser($attribute, $params)
    {
        if ($this->_admin === null) {
            $this->_admin = Admin::findByUsername($this->username);
        }
         if ($this->_admin){
                $this->addError($attribute, 'Incorrect password or repassword.');
            }
    }
}
