<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;


$this->title = 'Activity';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    [
        'class' => SerialColumn::class,
        'header' => 'Номер',
    ],
    'title',
    'start_day:datetime',
    'end_day:datetime',
    [
        'label' => 'Имя создателя',
        'attribute' => 'user_id', // авто-подключение зависимостей
        'value' => function ($model) {
            return $model->user->username;
        }
    ],
    'repeat:boolean',
    'main:boolean',
    'body',
];

?>

<div class="row">
    <h1>
        Список событий
        <?='asdfasd' ?>
    </h1>

    <div class="form-group pull-right">
        <?= Html::a('Назад', ['/admin'], ['class' => 'btn btn-success pull-right']) ?>
    </div>
</div>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => $columns,
]) ?>
