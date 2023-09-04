<?php

namespace app\controllers;
use yii\web\Controller as BaseController;
class SiteController extends BaseController
{
    public function actionIndex()
    {
        echo "Маршрут до контроллера SiteController::actionIndex достигнут!";
        return $this->render('index'); // Возвращаем представление для действия index
    }
}
