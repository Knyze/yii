<?php

namespace app\commands;


use app\models\User;
use yii\console\Controller;

class AppController extends Controller
{
    public function actionUsers() {
        $admin = new User([
            'username' => 'admin',
            //'password_hash' => '',
            //'auth_key' => '',
            'access_token' => 'test',
            //'created_at' => time(),
            //'updated_at' => time(),
        ]);
        
        $admin->generateAuthKey();
        $admin->password = 'admin';
        $admin->save();
        
        $user = new User([
            'username' => 'user',
            //'password_hash' => '',
            //'auth_key' => '',
            'access_token' => 'test0',
            //'created_at' => time(),
            //'updated_at' => time(),
        ]);
        
        $user->generateAuthKey();
        $user->password = 'user';
        $user->save();
    }
}