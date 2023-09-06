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
            echo 'Соединение с базой данных установлено успешно!';
        } catch (\yii\db\Exception $e) {
            echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
        }
        $users = User::find()->asArray()->all();
        return $this->asJson($users);

        //return $this->render('index'); // Возвращаем представление для действия index
    }
}
