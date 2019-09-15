<?php
/* @var $this yii\web\View */
?>

<h2>Добавлено новое событие</h2>

<?php foreach($model as $attribute => $value):?>

<p><?= $model->getAttributeLabel($attribute) . ': ' . $value ?></p>

<?php endforeach;?>