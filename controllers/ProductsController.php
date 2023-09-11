<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Request;
use app\models\Product;

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
        // Получение данных из БД
        $dbProducts = Product::find()->all();
        return $this->asJson(['success' => true, 'products' => $name]);
        // Загрузка данных из статического JSON файла
        $jsonFile = Yii::getAlias('@webroot/data/external-data.json'); // Укажите путь к файлу
        $jsonData = json_decode(file_get_contents($jsonFile), true);

        // Объединение данных
        $combinedData = array_merge($dbProducts, $jsonData);

        // Возвращаем объединенные данные как JSON
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $this->asJson(['success' => true, 'products' => $combinedData]);
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