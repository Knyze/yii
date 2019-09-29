<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form ActiveForm */

?>

<?php $form = ActiveForm::begin([ "action" => "/calendar/submit"]); ?>

<div class="col-lg-5">

    <h2>
        <?= $title_form ?>
    </h2>

    <?= $form->field($model, 'title') ?>
    
    <?= Html::activeHiddenInput($model, 'activity_id') ?>

    <?= $form->field($model, 'startDay')->textinput([type => 'datetime-local']) ?>

    <?= $form->field($model, 'endDay')->textinput([type => 'datetime-local']) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'repeat')->checkbox() ?>

    <?= $form->field($model, 'main')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Вернуться', ['/calendar/'], ['class' => 'btn btn-default pull-right']) ?>
    </div>

</div>

<?php ActiveForm::end(); ?>
