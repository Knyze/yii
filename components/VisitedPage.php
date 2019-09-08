<?php

namespace app\components;

use yii\base\Component;


class VisitedPage extends Component
{
    public function run() {
        $page = \Yii::$app->session->get('visitedPage', 'Впервые на нашем сайте?');
        $alias = \Yii::getAlias('@web'); // Не работает, из-за localhost? Никто не знает какой у меня сайт?
        \Yii::$app->session->set('visitedPage', 'Последняя страница, которую вы посетили: ' . $alias . \Yii::$app->request->getUrl());
        return $page;
    }
}