<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_img}}`.
 */
class m190429_152415_create_product_img_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_img}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(40)->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'product_img_fk',
            'product_img',
            'product_id',
            'product',
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
        $this->dropTable('{{%product_img}}');
    }
}
