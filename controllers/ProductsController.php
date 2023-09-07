<?php

namespace app\controllers;

use yii\web\Response;
use app\models\Product;
use yii\web\NotFoundHttpException;

class ProductsController extends Controller
{
    public function actionGetProducts(): Response
    {
        $query = Product::find()->asArray()->all();
        return $this->asJson(['success' => true, 'products' => $query]);
    }

    public function actionGetProduct($id): Response
    {
        $query = Product::findOne($id);
        if ($query === null) {
            return $this->asJson(['success' => false, 'message' => 'Продукт не найден']);
        }
        return $this->asJson(['success' => true, 'product' => $query]);
    }
}