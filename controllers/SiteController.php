<?php
namespace app\controllers;
use app\models\User;
use yii\web\Controller as BaseController;
class SiteController extends BaseController
{
    public function actionIndex()
    {
        //Yii::debug("Маршрут до контроллера SiteController::actionIndex достигнут!");
        return $this->render('index'); // Возвращаем представление для действия index
    }
}
