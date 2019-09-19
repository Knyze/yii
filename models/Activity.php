<?php

namespace app\models;


use yii\base\Model;

class Activity extends Model
{
    public $activity_id;
    public $user_id;
    public $title;
    public $startDay;
    public $endDay;
    public $body;
    public $repeat;
    public $main;
    
    public function attributeLabels() {
        return [
            'activity_id' => 'ID события',
            'user_id' => 'ID автора',
            'title' => 'Название события',
            'startDay' => 'Дата начала',
            'endDay' => 'Дата окончания',
            'body' => 'Описание события',
            'repeat' => 'Повторяющиеся событие',
            'main' => 'Основное событие',
        ];
    }
    
    public function rules() {
        return [
            [['startDay', 'endDay'], 'datetime', 'format' => 'y-MM-dd\'T\'HH:mm'],
            [['title', 'startDay', 'endDay', 'body', 'repeat', 'main'], 'required'],
            [['user_id'], 'integer'],
            [['repeat', 'main'], 'boolean'],
        ];
    }
    
    
}