<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%property_value}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%property}}`
 * - `{{%value}}`
 */
class m210304_134815_create_junction_table_for_property_and_value_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%property_value}}', [
            'property_id' => $this->integer(),
            'value_id' => $this->integer(),
            'PRIMARY KEY(property_id, value_id)',
        ]);

        // creates index for column `property_id`
        $this->createIndex(
            '{{%idx-property_value-property_id}}',
            '{{%property_value}}',
            'property_id'
        );

        // add foreign key for table `{{%property}}`
        $this->addForeignKey(
            '{{%fk-property_value-property_id}}',
            '{{%property_value}}',
            'property_id',
            '{{%property}}',
            'id',
            'CASCADE'
        );

        // creates index for column `value_id`
        $this->createIndex(
            '{{%idx-property_value-value_id}}',
            '{{%property_value}}',
            'value_id'
        );

        // add foreign key for table `{{%value}}`
        $this->addForeignKey(
            '{{%fk-property_value-value_id}}',
            '{{%property_value}}',
            'value_id',
            '{{%value}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%property}}`
        $this->dropForeignKey(
            '{{%fk-property_value-property_id}}',
            '{{%property_value}}'
        );

        // drops index for column `property_id`
        $this->dropIndex(
            '{{%idx-property_value-property_id}}',
            '{{%property_value}}'
        );

        // drops foreign key for table `{{%value}}`
        $this->dropForeignKey(
            '{{%fk-property_value-value_id}}',
            '{{%property_value}}'
        );

        // drops index for column `value_id`
        $this->dropIndex(
            '{{%idx-property_value-value_id}}',
            '{{%property_value}}'
        );

        $this->dropTable('{{%property_value}}');
    }
}
