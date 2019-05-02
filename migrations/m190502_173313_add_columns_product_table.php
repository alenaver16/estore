<?php

use yii\db\Migration;

/**
 * Class m190502_173313_add_columns_product_table
 */
class m190502_173313_add_columns_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'creation_date', $this->dateTime());
        $this->addColumn('product', 'edit_date', $this->dateTime());
        $this->addColumn('product', 'main_image', $this->string(100));
        $this->addColumn('product', 'sale_price', $this->double(2)->unsigned());
        $this->addForeignKey(
            'main_img_fk',
            'product',
            'main_image',
            'product_img',
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
        $this->dropColumn('product', 'creation_date');
        $this->dropColumn('product', 'edit_date');
        $this->dropForeignKey(
            'main_img_fk',
            'product_img'
        );
        $this->dropColumn('product', 'main_image');
        $this->dropColumn('product', 'sale_price');
    }

}
