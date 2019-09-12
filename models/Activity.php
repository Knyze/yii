<?php

namespace app\models;


use yii\base\Model;

class Activity extends Model
{
    public $id;
    public $title;
    public $startDay;
    public $endDay;
    public $idUser;
    public $body;
    public $repeat;
    public $main;
    
    public function attributeLabels() {
        return [
            'id' => 'ID события',
            'title' => 'Название события',
            'startDay' => 'Дата начала',
            'endDay' => 'Дата окончания',
            'idUser' => 'ID автора',
            'body' => 'Описание события',
            'repeat' => 'Повторяющиеся событие',
            'main' => 'Основное событие',
        ];
    }
    
    public function rules() {
        return [
            //[['startDay'], 'date'],
            [['title', 'startDay', 'endDay', 'body', 'repeat', 'main'], 'required'],
        ];
    }
}