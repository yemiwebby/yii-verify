<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%temporary_user}}`.
 */
class m210404_083751_create_temporary_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%temporary_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'country_code' => $this->string(),
            'number' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%temporary_user}}');
    }
}