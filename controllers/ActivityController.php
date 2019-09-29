<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\Activity;
use yii\helpers\VarDumper;
use yii\db\QueryBuilder;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

class ActivityController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'edit', 'delete', 'submit'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'edit', 'delete', 'submit'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        //$db = \Yii::$app->db;
        //$query = $db->createCommand('select * from activities_tbl');
        //$rows = $query->queryAll();
        
        $query = Activity::find();

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
    
    public function actionView($id) {
        return $this->render('view', [
            'model' => Activity::findOne($id),
        ]);
    }
    
    public function actionCreate() {
        
        $model = new Activity();
        $model->start_day = time();
        $model->end_day = time();
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionEdit($id) {
        
        $query = Activity::find();
        $query->where(['activity_id' => +$id]);
        
        return $this->render('edit', [
            'model' => $query->one(),
        ]);
    }
    
    public function actionSubmit() {
        $model = new Activity();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                
                $model->user_id = \Yii::$app->user->getID();
                
                if (empty($model->activity_id)) {
                    $model->save();
                } else {
                    $modelAR = Activity::findOne([
                        'activity_id' => $model->activity_id,
                        'user_id' => $model->user_id,
                    ]);
                    
                    if (is_null($modelAR)) {
                        return \Yii::$app->getResponse()->redirect('/activity');
                    }
                    
                    $modelAR->attributes = $model->attributes;
                    $modelAR->save();
                }
                
                /*
                $params = [];
                $query = new QueryBuilder(\Yii::$app->db);
                $sql = $query->insert('activities_tbl', $model->attributes, $params);
                
                //die(VarDumper::export($params));

                \Yii::$app->db
                    ->createCommand($sql, $params)
                    ->execute();
                */
                
                
                
                //$model->setIsNewRecord(!$model->activity_id);
                //$model->setIsNewRecord(false);
                //die(VarDumper::export($model->getIsNewRecord()));
                //$model->save();
                //die(VarDumper::export($model->errors));
                
                //$model1 = Activity::find()->where(['activity_id' => +$model->activity_id])->one();
                //$model1->attributes = $model->attributes;
                
                //$model1->save();
                
                return $this->render('submit', [
                    'model' => $model,
                ]);
                
            } else {
                return "Failed: " . VarDumper::export($model->errors);
            }
        }
    }
    
    public function actionDelete($id) {
        $query = Activity::find();
        $model = $query->where(['activity_id' => +$id])->one();
        $model->delete();
        return \Yii::$app->getResponse()->redirect('/activity');
    }
    

}
