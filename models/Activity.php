<?php

namespace app\models;


use yii\db\ActiveRecord;

class Activity extends ActiveRecord
{
    public static function tableName() {
        return 'activities_tbl';
    }
    
    public function attributeLabels() {
        return [
            'activity_id' => 'ID события',
            'user_id' => 'ID автора',
            'title' => 'Название события',
            'start_day' => 'Дата начала',
            'end_day' => 'Дата окончания',
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
            [['activity_id', 'user_id'], 'integer'],
            [['repeat', 'main'], 'boolean'],
            [['endDay'], 'validateStartEndDays'],
        ];
    }
    
    public function validateStartEndDays($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->start_day > $this->end_day) {
                $this->addError($attribute, 'Некорректные даты');
            }
        }
    }
    
    public function getUser() {
        return $this->hasOne(User::classname(), ['user_id' => 'user_id']);
    }
        
    public function getStartDay() {
        return date('Y-m-d', $this->start_day) . 'T' . date('H:i', $this->start_day);
    }
    
    public function setStartDay($value) {
        $date = \DateTime::createFromFormat('Y-m-d*H:i', $value);
        $this->start_day = $date->format('U');
    }
    
    public function getEndDay() {
        return date('Y-m-d', $this->end_day) . 'T' . date('H:i', $this->end_day);
    }
    
    public function setEndDay($value) {
        $date = \DateTime::createFromFormat('Y-m-d*H:i', $value);
        $this->end_day = $date->format('U');
    }
    
}