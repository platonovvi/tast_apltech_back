<?php

namespace app\controllers;
use app\models\User;
use yii\web\Controller as BaseController;
class SiteController extends BaseController
{
    public function actionIndex()
    {
        echo "Маршрут до контроллера SiteController::actionIndex достигнут!";
        $users = User::find()->asArray()->all();
        return $this->asJson($users);
        //return $this->render('index'); // Возвращаем представление для действия index
    }
}
