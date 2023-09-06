<?php
namespace app\controllers;
use app\models\User;
use yii\web\Controller as BaseController;
class SiteController extends BaseController
{
    public function actionIndex()
    {
        //Yii::debug("Маршрут до контроллера SiteController::actionIndex достигнут!");
        try {
            Yii::$app->db->open();
            return $this->render('index');
            echo 'Соединение с базой данных установлено успешно!';
        } catch (\yii\db\Exception $e) {
            $users = User::find()->asArray()->all();
            return $this->asJson($users);
            echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
        }


        //return $this->render('index'); // Возвращаем представление для действия index
    }
}
