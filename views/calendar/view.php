<?php

/**
 * @var $this yii\web\View
 * @var $model Activity
 */

use app\models\Activity;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
    <div class="row">
        <h1>Просмотр события</h1>

        <div class="form-group pull-right">
            <?= Html::a('Вернуться', ['calendar/'], ['class' => 'btn btn-info']) ?>
            <?= Html::a('Изменить', ['calendar/update', 'id' => $model->activity_id], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            // activity.id - пример перезаписи названия столбца
            'label' => 'Номер',
            'attribute' => 'activity_id',
        ],
        [
            // activity.id - пример перезаписи значения
            'label' => 'Порядковый номер',
            'value' => function (Activity $model) {
                return "# {$model->activity_id}";
            },
        ],
        //'id',
        'title',
        'startDay:datetime',
        'endDay:date',
        [
            // так делать плохо, лучше как ниже (авто-форматирование)
            'attribute' => 'start_day',
            'value' => function (Activity $model) {
                return Yii::$app->formatter->asDate($model->start_day, 'php:Y');
            }
        ],
        [
            'attribute' => 'end_day',
            'format' => ['date', 'php:Y'], // форматирование даты
            //'value' => function (Activity $model) {
            //    return Yii::$app->formatter->asDate($model->date_end, 'php:Y');
            //}
        ],
        //'user_id',
        [
            'label' => 'Имя создателя',
            'attribute' => 'user.username', // авто-подключение зависимостей
            // $model->user->username
        ],
        'body',
        'repeat:boolean', // Yii::$app->formatter->asBoolean(...)
        'main:boolean',
    ],
]); ?>