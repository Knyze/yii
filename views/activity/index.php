<?php

/**
 * @var $this yii\web\View
 * @var \app\models\Activity[] $activities
 */

use yii\helpers\Html;
use yii\helpers\VarDumper;

//var_dump($activities[0]->attributes);

?>

<div class="row">
    <h1>Список событий</h1>

    <div class="form-group pull-right">
        <?= Html::a('Создать', ['activity/create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>
</div>

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
