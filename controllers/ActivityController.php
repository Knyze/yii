<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Activity;
use yii\helpers\VarDumper;
use yii\db\QueryBuilder;

class ActivityController extends Controller
{
    public function actionIndex() {
        $db = \Yii::$app->db;
        $rows = $db->createCommand('select * from activities_tbl')->queryAll();
        //$model = new Activity();
        return $this->render('index', [
            'activities' => $rows,
        ]);
    }
    
    public function actionView() {
        return $this->render('submit', [
            'model' => new Activity(),
        ]);
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
                
                $params = [];
                $query = new QueryBuilder(\Yii::$app->db);
                $sql = $query->insert('activities_tbl', $model->attributes, $params);
                
                //die(VarDumper::export($params));

                \Yii::$app->db
                    ->createCommand($sql, $params)
                    ->execute();
                
                return $this->render('submit', [
                    'model' => $model,
                ]);
                
            } else {
                return "Failed: " . VarDumper::export($model->errors);
            }
        }
    }
    

}
