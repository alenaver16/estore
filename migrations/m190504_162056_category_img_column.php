<?php

use yii\db\Migration;

/**
 * Class m190504_162056_category_img_column
 */
class m190504_162056_category_img_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'image', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'image');
    }
}
