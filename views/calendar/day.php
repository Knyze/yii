<?php

/**
 * @var $this yii\web\View
 * @var \app\models\Activity[] $activities
 */

use yii\helpers\Html;
use yii\helpers\VarDumper;
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
    [
        'label' => 'Время начала',
        'attribute' => 'start_day',
        'format' => ['datetime', 'php:H:i'],
    ],
    [
        'label' => 'Дата окончания',
        'attribute' => 'end_day',
        'format' => ['datetime', 'php:d-m-Y H:i'],
    ],
    'title',
    [
        'label' => 'Имя создателя',
        'attribute' => 'user_id',
        'value' => function ($model) {
            return $model->user->username;
        }
    ],
    'body',
    'repeat:boolean', // Yii::$app->formatter->asBoolean(...)
    'main:boolean',
    [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'template' => '{view} {update} {delete}',
    ],
];


?>

<div class="row">
    <h1>События на <?= $day->format('j F Y') ?></h1>
    <div class="form-group pull-right">
        <?= Html::a('Создать', ['calendar/create?day=' . $day->getTimestamp() ], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Вернуться', ['calendar/index?m=' . $mountOffset ], ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => $columns,
]) ?>



