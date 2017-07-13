<?php

namespace backend\models\form;

use Yii;
use backend\models\User;
use yii\base\Model;

/**
 * Description of HeadimgModify
 *
 * @author cbn
 * @since 1.0
 */
class HeadimgModify extends Model
{
    public $useravatar;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['useravatar'],'file', 'skipOnEmpty' => false,'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
        ];
    }
    /**
     * Change useravatar.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function change()
    {
        if ($this->validate()) {
            /* @var $user User */
            $user = Yii::$app->user->identity;
            $user->setPassword($this->newPassword);
            $user->generateAuthKey();
            if ($user->save()) {
                return true;
            }
        }

        return false;
    }
}
