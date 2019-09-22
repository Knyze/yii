<?php

$this->title = 'Edit';
$this->params['breadcrumbs'][] = [ 'label' => 'Activities', 'url' => '/activity/'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="activity-create row">

    <?= $this->render('form_activity', [
        'title_form' => 'Редактирование активности:',
        'model' => $model,
    ]) ?>

</div>
