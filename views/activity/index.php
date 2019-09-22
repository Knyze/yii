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

//var_dump($activities[0]->attributes);

$this->title = 'Activity';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    [
        'class' => SerialColumn::class,
        'header' => 'Номер',
    ],
    //[
    //    // activity.id - пример перезаписи названия столбца
    //    'label' => 'Порядковый номер',
    //    'attribute' => 'id',
    //],
    //[
    //    // activity.id - пример перезаписи значения
    //    'label' => 'Порядковый номер',
    //    'value' => function (Activity $model) {
    //        return "# {$model->id}";
    //    },
    //],
    //'id',
    'title',
    'start_day:datetime',
    [
        'label' => 'Создано',
        'attribute' => 'created_at',
        'format' => ['datetime', 'php:d-m-Y H:i'],
    ],
    //'user_id',
    [
        'label' => 'Имя создателя',
        'attribute' => 'user_id', // авто-подключение зависимостей
        'value' => function ($model) {
            return $model->user->username;
        }
        // $model->user->username
    ],
    'repeat:boolean', // Yii::$app->formatter->asBoolean(...)
    'main:boolean',
    [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'template' => '{view} {edit} {delete}',
        'buttons' => [
            'edit' => function ($url, $model, $key) {
                return Html::a('', $url, ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ]
];

/*
if (Yii::$app->user->can('user')) {
    $columns[] = [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'template' => '{view} {update} {delete} {edit}',
        'buttons' => [
            'edit' => function ($url, $model, $key) {
                return Html::a('Custom', $url);
            }
        ],
    ];
}

<ul>
    <?php foreach ($activities as $activity): ?>
    <li>
        <ul>
            <?php foreach ($activity->attributes as $attr => $value):?>

            <li>
                <?= $activity->getAttributeLabel($attr) . ': ' . $value ?>
            </li>    
            
            <?php endforeach ?>
            <li>
                <?= $activity->user->username ?>
            </li>
            
            <?= Html::a('Редактировать', ["activity/edit?id={$activity->activity_id}"], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ["activity/delete?id={$activity->activity_id}"], ['class' => 'btn btn-danger']) ?>
        </ul>
    </li>
    <?php endforeach ?>
</ul>
*/


?>

<div class="row">
    <h1>Список событий</h1>

    <div class="form-group pull-right">
        <?= Html::a('Создать', ['activity/create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>
</div>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => $columns,
]) ?>



