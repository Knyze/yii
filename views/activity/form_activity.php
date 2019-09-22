<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form ActiveForm */

?>

<?php $form = ActiveForm::begin([ "action" => "/activity/submit"]); ?>

<div class="col-lg-5">

    <h2>
        <?= $title_form ?>
    </h2>

    <?= $form->field($model, 'title') ?>
    
    <?= Html::activeHiddenInput($model, 'activity_id') ?>

    <? /*= $form->field($model, 'startDay')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => "1-2-y h:s",
                'clientOptions' => [
                    'alias' => 'datetime',
                    "placeholder" => "dd-mm-yyyy hh:mm",
                    "separator" => "-",
                ]]); */ ?>


    <? /*= $form->field($model, 'endDay')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => "1-2-y h:s",
                'clientOptions' => [
                    'alias' => 'datetime',
                    "placeholder" => "dd-mm-yyyy hh:mm",
                    "separator" => "-",
                ]]); */ ?>

    <?= $form->field($model, 'startDay')->textinput([type => 'datetime-local']) ?>

    <?= $form->field($model, 'endDay')->textinput([type => 'datetime-local']) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'repeat')->checkbox() ?>

    <?= $form->field($model, 'main')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Вернуться', ['/activity/'], ['class' => 'btn btn-default pull-right']) ?>
    </div>

</div>

<?php ActiveForm::end(); ?>
