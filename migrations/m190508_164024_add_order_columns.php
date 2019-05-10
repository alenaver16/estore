<?php

use yii\db\Migration;

/**
 * Class m190508_164024_add_order_columns
 */
class m190508_164024_add_order_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'total_price' => $this->double(2)->unsigned()->notNull(),
            'user_id' => $this->integer(),
            'first_name' => $this->string(40),
            'last_name' => $this->string(40),
            'email' => $this->string(40),
            'phone' => $this->string(40),
            'country' => $this->string(40),
            'city' => $this->string(40),
            'address' => $this->string(40),
            'postcode' => $this->string(40),
            'note' => $this->text(),
            'shipping_method' =>  $this->string(40)->defaultValue('Free Shipping'),
            'order_date' => $this->dateTime()
        ]);

        $this->createTable('order_product', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'count' => $this->integer()->unsigned()->notNull()->defaultValue(1),
            'price' => $this->double(2)->unsigned()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'product_order_fk',
            'order_product',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'order_fk',
            'order_product',
            'order_id',
            'order',
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
            'user_order_fk',
            'order'
        );
        $this->dropForeignKey(
            'order_fk',
            'order'
        );
        $this->dropForeignKey(
            'product_order_fk',
            'order_product'
        );
        $this->dropTable('order_product');
        $this->dropTable('order');
    }
}
