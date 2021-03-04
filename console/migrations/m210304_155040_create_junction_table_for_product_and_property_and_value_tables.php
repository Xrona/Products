<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_property_value}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%property}}`
 * - `{{%value}}`
 */
class m210304_155040_create_junction_table_for_product_and_property_and_value_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_property_value}}', [
            'product_id' => $this->integer(),
            'property_id' => $this->integer(),
            'value_id' => $this->integer(),
            'PRIMARY KEY(product_id, property_id, value_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-product_property_value-product_id}}',
            '{{%product_property_value}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-product_property_value-product_id}}',
            '{{%product_property_value}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `property_id`
        $this->createIndex(
            '{{%idx-product_property_value-property_id}}',
            '{{%product_property_value}}',
            'property_id'
        );

        // add foreign key for table `{{%property}}`
        $this->addForeignKey(
            '{{%fk-product_property_value-property_id}}',
            '{{%product_property_value}}',
            'property_id',
            '{{%property}}',
            'id',
            'CASCADE'
        );

        // creates index for column `value_id`
        $this->createIndex(
            '{{%idx-product_property_value-value_id}}',
            '{{%product_property_value}}',
            'value_id'
        );

        // add foreign key for table `{{%value}}`
        $this->addForeignKey(
            '{{%fk-product_property_value-value_id}}',
            '{{%product_property_value}}',
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
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-product_property_value-product_id}}',
            '{{%product_property_value}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-product_property_value-product_id}}',
            '{{%product_property_value}}'
        );

        // drops foreign key for table `{{%property}}`
        $this->dropForeignKey(
            '{{%fk-product_property_value-property_id}}',
            '{{%product_property_value}}'
        );

        // drops index for column `property_id`
        $this->dropIndex(
            '{{%idx-product_property_value-property_id}}',
            '{{%product_property_value}}'
        );

        // drops foreign key for table `{{%value}}`
        $this->dropForeignKey(
            '{{%fk-product_property_value-value_id}}',
            '{{%product_property_value}}'
        );

        // drops index for column `value_id`
        $this->dropIndex(
            '{{%idx-product_property_value-value_id}}',
            '{{%product_property_value}}'
        );

        $this->dropTable('{{%product_property_value}}');
    }
}
