<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%value}}`.
 */
class m210304_134644_create_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%value}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%value}}');
    }
}
