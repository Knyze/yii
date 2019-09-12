<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Activity;

class ActivityController extends Controller
{
    public function actionIndex() {
        $model = new Activity();
        return $this->render('index', ['model' => $model]);
    }
    
    public function actionCreate() {
        return $this->render('create', [
            'model' => new Activity(),
        ]);
    }
    
    public function actionSubmit() {
        $model = new Activity();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                return $this->render('submit', [
                    'model' => $model,
                ]);
            }
        }
    }
    

}
