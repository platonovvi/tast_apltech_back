<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210828_123456_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('cat_users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->comment('Логин пользователя'),
            'password' => $this->string()->notNull()->comment('Пароль'),
            'api_token' => $this->string()->notNull()->comment('JWT'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('cat_users');
    }
}