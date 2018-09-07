<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180907_035500_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->unique(),
            'password' => $this->string(30)->notNull()->unique(),
            'authKey' => $this->string()->notNull()->unique(),
            'accessToken' => $this->string()->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
