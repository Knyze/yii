<?php

namespace app\models;


use yii\base\Model;

class Day extends Model
{
    public $date;
    public $working;
    public $activity;
    
    public function attributeLabels() {
        return [
            'date'=>'День',
            'working'=>'Рабочий',
            'activity'=>'События',
        ];
    }

}