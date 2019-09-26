<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Activity;
use yii\db\QueryBuilder;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;


class CalendarController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'submit', 'day'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex($m = 0) {
        
        $firstDayMount = new \DateTime('first day of this month');
        $firstDayMount->setTime(0, 0, 0);
        
        $lastDayMount = new \DateTime('last day of this month');
        $lastDayMount->setTime(23, 59, 59);
        
        if ($m < 0) {
            $firstDayMount->sub(new \DateInterval('P' . -$m . 'M'));
            $lastDayMount->sub(new \DateInterval('P' . -$m . 'M'));
        } else {
            $firstDayMount->add(new \DateInterval('P' . +$m . 'M'));
            $lastDayMount->add(new \DateInterval('P' . +$m . 'M'));
        };
        
        $rows = (new \yii\db\Query())
            ->select([
                //'activity_id',
                "from_unixtime(`start_day`, '%e') day",
                "from_unixtime(`start_day`, '%k:%i') time",
                'title',
            ])
            ->from('activities_tbl')
            ->where(['user_id' => \Yii::$app->user->getID()])
            ->andWhere(['between', 'start_day', $firstDayMount->getTimestamp(), $lastDayMount->getTimestamp()])
            ->orderBy('start_day')
            ->all();
        
        return $this->render('calendar', [
            'events' => $rows,
            'firstDayMount' => $firstDayMount,
            'mountOffset' => +$m,
        ]);
    }
    
    public function actionDay($m = 0, $d = 1) {
        
        $firstDayMount = new \DateTime('first day of this month');
        
        if ($m < 0) {
            $firstDayMount->sub(new \DateInterval('P' . -$m . 'M'));
        } else {
            $firstDayMount->add(new \DateInterval('P' . +$m . 'M'));
        };
        if ($d > 1) {
            $firstDayMount->add(new \DateInterval('P' . (+$d-1) . 'D'));
        }
        
        $query = Activity::find()
            ->where(['user_id' => \Yii::$app->user->getID()])
            ->andWhere(["from_unixtime(`start_day`, '%e')" => $firstDayMount->format('j')])
            ->orderBy('start_day');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'validatePage' => false,
            ],
        ]);
        
        return $this->render('day', [
            'provider' => $provider,
            'day' => $firstDayMount,
            'mountOffset' => +$m,
        ]);
        
    }
    
    public function actionView($id) {
        return $this->render('view', [
            'model' => Activity::findOne($id),
        ]);
    }
    
    public function actionCreate($day = NULL) {
        
        $model = new Activity();
        
        if ($day == NULL) {
            $model->start_day = time();
            $model->end_day = time();
        } else {
            $model->start_day = $day;
            $model->end_day = $day;
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id) {
        
        $query = Activity::find();
        $query->where(['activity_id' => +$id]);
        
        return $this->render('update', [
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
                
                return $this->actionIndex();
                
            } else {
                return "Failed: " . VarDumper::export($model->errors);
            }
        }
    }
    
    public function actionDelete($id) {
        $query = Activity::find();
        $model = $query->where(['activity_id' => +$id])->one();
        $model->delete();
        return $this->actionIndex();
    }
    
}