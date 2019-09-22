<?php

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName() {
        return 'users_tbl';
    }

    public static function findIdentity($id) {
        return self::findOne(['user_id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return self::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username) {
        return self::findOne(['username' => $username]);
    }

    public function getId() {
        return $this->user_id;
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password) {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    public function generateAuthKey() {
        $this->auth_key = \yii::$app->security->generateRandomString();
    }
    
    public function setPassword($password) {
        $this->password_hash = \yii::$app->security->generatePasswordHash($password);
    }
}
