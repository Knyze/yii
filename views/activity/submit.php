<?php
/* @var $this yii\web\View */
//var_dump($model->attributes);
?>

<h2>Добавлено новое событие</h2>

<?php foreach($model as $attribute => $value):?>

<p><?= $model->getAttributeLabel($attribute) . ': ' . $value ?></p>

<?php endforeach;?>
