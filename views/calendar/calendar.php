<?php

use yii\helpers\Html;
use app\assets\CalendarAsset;
use yii\helpers\Url;


$firstDayWeek = $firstDayMount->format('N');
$mountTitle = $firstDayMount->format('F Y');

$currentMount = $firstDayMount->format('n');
$currentYear = $firstDayMount->format('Y');
$numberOfDays = cal_days_in_month(CAL_GREGORIAN, $currentMount, $currentYear);

CalendarAsset::register($this);

$styleFirstDay = "style='grid-column-start:" . $firstDayWeek . "'";

/*
<a href="/calendar/day?m=<?= $mountOffset . '&d=' . $i ?>" <?=($i == 1) ? $styleFirstDay : '' ?>>
<a href="<?= Url::to('/calendar/day?m=' . $mountOffset . '&d=' . $i) ?>" <?=($i == 1) ? $styleFirstDay : '' ?>>
*/

?>

<div class="row">
    <?= Html::a('<<', ['calendar/index?m=' . ($mountOffset-1)], ['class' => 'btn btn-lg col-lg-offset-5 col-lg-1']) ?>
    <h4 class="col-lg-2">
        <?= $mountTitle ?>
    </h4>
    <?= Html::a('>>', ['calendar/index?m=' . ($mountOffset+1)], ['class' => 'btn btn-lg col-lg-1']) ?>
</div>

<div class="monthHeader">
    <div>Понедельник</div>
    <div>Вторник</div>
    <div>Среда</div>
    <div>Четверг</div>
    <div>Пятница</div>
    <div>Суббота</div>
    <div>Воскресенье</div>
</div>

<div class="month">

    <?php for($i = 1; $i <= $numberOfDays; $i++): ?>

        <a href="<?= Url::to('/calendar/day/' . $mountOffset . '/' . $i) ?>" <?=($i == 1) ? $styleFirstDay : '' ?>>
            <div class="day">
                <h6><?= $i ?></h6>
                <?php foreach($events as $activity): ?>
                    <?php if($activity['day'] == $i): ?>
                        <p>
                            <?= $activity['time'] . ' ' . $activity['title'] ?>
                        </p>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </a>

    <?php endfor ?>

</div>
