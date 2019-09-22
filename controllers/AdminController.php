<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use app\models\Activity;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\models\SignupForm;


class AdminController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'view', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        $query = User::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'validatePage' => false,
            ],
        ]);

        return $this->render('index', [
            'provider' => $provider,
        ]);
    }
    
    public function actionCreate() {
        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post()) && $model->register(false)) {
            return $this->actionIndex();
        }

        $model->password = '';
        return $this->render('createUser', [
            'model' => $model,
        ]);
    }
    
    public function actionView($id) {
        $query = Activity::find();
        $query->where(['user_id' => $id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'validatePage' => false,
            ],
        ]);

        return $this->render('view', [
            'provider' => $provider,
        ]);
    }
    
    public function actionDelete($id) {
        $user = User::findOne(['user_id' => +$id]);
        $user->delete();
        return \Yii::$app->getResponse()->redirect('/admin');
    }
}

