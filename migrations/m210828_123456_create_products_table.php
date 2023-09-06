<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210828_123456_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('cat_products', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'category_name' => $this->string()->notNull()->comment('Категория'),
            'brand_name' => $this->string()->notNull()->comment('Наименование бренда'),
            'price' => $this->integer()->notNull()->comment('Цена'),
            'rrp_price' => $this->integer()->notNull()->comment('Цена rrp'),
            'status' => $this->integer()->notNull()->comment('Статус (1 - В наличии, 2 - Под заказ)'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('cat_products');
    }
}