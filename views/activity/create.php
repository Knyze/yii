<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form ActiveForm */
?>
<div class="activity-create row">
   
    <?php $form = ActiveForm::begin([ "action" => '/activity/submit']); ?>
        
        <div class="col-lg-5">
          
            <h2>Форма для ввода активности: </h2>
           
            <?= $form->field($model, 'title') ?>
            
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
            
            <?//= $form->field($model, 'startDay')->textinput([type => 'date']) ?>
            <?//= $form->field($model, 'endDay')->textinput([type => 'date']) ?>
            
            <?= $form->field($model, 'body')->textarea(['rows' => 4]) ?>
            
            <?= $form->field($model, 'repeat')->checkbox() ?>
            
            <?= $form->field($model, 'main')->checkbox() ?>
            
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            
        </div>
        
    <?php ActiveForm::end(); ?>

</div><!-- activity-create -->
