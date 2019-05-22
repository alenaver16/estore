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
        $this->insert('group', [
            'name' => 'Other'
        ]);
        $this->insert('category', [
            'name' => 'Other',
            'group_id' => Yii::$app->db->createCommand('SELECT id FROM `group` WHERE name="Other"')->execute()
        ]);

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
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull(),
            'description' => $this->text()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'product_fk',
            'product_characteristic',
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
        $this->dropForeignKey(
            'category_fk',
            'product'
        );
        $this->dropForeignKey(
            'group_fk',
            'category'
        );
        $this->dropTable('product_characteristic');
    }
}