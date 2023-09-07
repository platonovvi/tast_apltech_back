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
        return $this->asJson($query);
    }

    public function actionGetProduct($id): Response
    {
        $product = Product::findOne($id);
        if ($product === null) {
            return $this->asJson(['success' => false, 'message' => 'Продукт не найден']);
        }
        return $this->asJson(['success' => true, 'product' => $product]);
    }
}