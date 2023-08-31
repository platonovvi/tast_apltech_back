<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use yii\web\Controller as BaseController;
use Yii;
use yii\web\Response;

class SiteController extends BaseController
{
    public function actionIndex()
    {
        Yii::info('Метод actionIndex() был вызван.');
        return $this->render('index'); // Возвращаем представление для действия index
    }
}
