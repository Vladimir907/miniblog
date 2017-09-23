<?php

namespace app\models;

use Yii;
use yii\base\Model;


class SignupForm extends Model
{
    public $name;
    public $password;
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name','email','password'], 'required'],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email']
        ];
    }

    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->create();
            return Yii::$app->user->login($user);
        }
    }
}
