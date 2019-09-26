<?php

$this->title = 'Create';
$this->params['breadcrumbs'][] = [ 'label' => 'Activities', 'url' => '/activity/'];
$this->params['breadcrumbs'][] = $this->title;

?>
    
<div class="activity-create row">

    <?= $this->render('form_activity', [
        'title_form' => 'Новая активность',
        'model' => $model,
    ]) ?>

</div>
