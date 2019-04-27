<?php

use yii\db\Migration;

/**
 * Class m190427_094332_create_foreign_keys_and_adjacent_tbl
 */
class m190427_094332_create_foreign_keys_and_adjacent_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'category_fk',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'group_fk',
            'category',
            'group_id',
            'group',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createTable('product_characteristic', [
            'characteristic_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'characteristic_fk',
            'product_characteristic',
            'characteristic_id',
            'characteristic',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'product_fk',
            'product_characteristic',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'count' => $this->integer()->unsigned()->notNull()->defaultValue(1),
            'price' => $this->double(2)->unsigned()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'order_date' => $this->dateTime()
        ]);
        $this->addForeignKey(
            'product_order_fk',
            'order',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_order_fk',
            'order',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'category_fk',
            'product'
        );
        $this->dropForeignKey(
            'group_fk',
            'category'
        );
        $this->dropTable('order');
        $this->dropTable('product_characteristic');
    }
}