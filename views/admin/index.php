<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;


$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    [
        'class' => SerialColumn::class,
        'header' => 'Номер',
    ],
    'username',
    'created_at:datetime',
    'updated_at:datetime',
    [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'template' => '{view} {delete}',
    ]
];

?>

<div class="row">
    <h1>Зарегистрированные пользователи</h1>

    <div class="form-group pull-right">
        <?= Html::a('Создать', ['admin/create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>
</div>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => $columns,
]) ?>



