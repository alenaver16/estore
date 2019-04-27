<?php

use yii\db\Migration;

/**
 * Class m190425_190825_create_product_tbl
 */
class m190425_190825_create_product_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull()->unique(),
            'price' => $this->double(2)->unsigned()->notNull(),
            'category_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }

}
