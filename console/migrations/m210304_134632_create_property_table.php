<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%property}}`.
 */
class m210304_134632_create_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%property}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%property}}');
    }
}
