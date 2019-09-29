<?php

$this->title = 'Update';
$this->params['breadcrumbs'][] = [ 'label' => 'Calendar', 'url' => '/calendar/'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="activity-create row">

    <?= $this->render('form_activity', [
        'title_form' => 'Редактирование активности:',
        'model' => $model,
    ]) ?>

</div>
