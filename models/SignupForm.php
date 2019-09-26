<?php

namespace app\models;


use app\models\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    
    public function attributeLabels() {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function rules() {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string'],
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['username'], 'string', 'min' => 3],
            [['password'], 'string', 'min' => 4, 'max' => 32],
        ];
    }

    public function register($auth = true) {
        
        if ($this->validate()) {
            $user = new User([
                'username' => $this->username,
                'access_token' => "{$this->username}-token",
                //'created_at' => time(),
                //'updated_at' => time(),
            ]);

            $user->generateAuthKey();
            $user->password = $this->password;

            if ($user->save()) {
                if ($auth) {
                    return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
                } else {
                    return true;
                }
            }
        }
        
        return false;
    }
}
