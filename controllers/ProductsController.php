<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Request;
use app\models\Product;
use yii\helpers\ArrayHelper;

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
            return $this->asJson(['success' => false, 'message' => 'Товар не найден']);
        }
        return $this->asJson(['success' => true, 'product' => $query]);
    }

    public function actionFindBrand($name): Response
    {
        $name = strtolower($name);
        // Полученаю данных из БД с фильтрацие по brand_name
        $dbProducts = Product::find()
            ->where(['ILIKE', 'brand_name', $name])
            ->all();

        // Загрузка данных из статического JSON файла
        $jsonFile = Yii::getAlias('@webroot/external-data.json');
        $jsonData = json_decode(file_get_contents($jsonFile), true);

//Фильтрую входные данные из JSON по brand_name
        $jsonData = array_filter($jsonData, function ($product) use ($name) {
            return isset($product['brand_name']) && strtolower($product['brand_name']) === $name;
        });

        // Объединение данных
        $combinedData = array_merge($dbProducts, $jsonData);
        //Отбираем минимальный и максимальный по цене товары
        usort($combinedData, function ($a, $b) {
            return $a['price'] - $b['price'];
        });
        $minPrice = reset($combinedData);
        $maxPrice = end($combinedData);
        $result = [$minPrice, $maxPrice];
        return $this->asJson(['success' => true, 'products' => $result]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);

        $name = $postData['name'];
        $category_name = $postData['category_name'];
        $brand_name = $postData['brand_name'];
        $price = $postData['price'];
        $rrp_price = $postData['rrp_price'];
        $status = $postData['status'];
        $description = $postData['description'];

        $product = new Product();

        $product->name = $name;
        $product->category_name = $category_name;
        $product->brand_name = $brand_name;
        $product->price = $price;
        $product->rrp_price = $rrp_price;
        $product->status = $status;
        $product->description = $description;
        if ($product->save()) {
            return ['success' => true, 'message' => 'Товар создан!'];
        } else {
            return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
        }
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);
        $product = Product::findOne($id);

        if (!$product) {
            return ['success' => false, 'message' => 'Товар не найден'];
        }
        $name = $postData['name'];
        $category_name = $postData['category_name'];
        $brand_name = $postData['brand_name'];
        $price = $postData['price'];
        $rrp_price = $postData['rrp_price'];
        $status = $postData['status'];
        $description = $postData['description'];

        $product->name = $name;
        $product->category_name = $category_name;
        $product->brand_name = $brand_name;
        $product->price = $price;
        $product->rrp_price = $rrp_price;
        $product->status = $status;
        $product->description = $description;
        if ($product->save()) {
            return ['success' => true, 'message' => 'Товар изменён!'];
        } else {
            return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
        }
    }
}