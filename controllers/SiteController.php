<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
class SiteController extends Controller
{
    public function actionHello()
    {
        return $this->render('hello');
    }
    public function actionIndex()
    {
        return $this->render('index'); // Возвращаем представление для действия index
    }
}
