<?php

use yii\db\Migration;

/**
 * Class m190425_194037_create_category_tbl
 */
class m190425_194037_create_category_tbl extends Migration
{
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull()->unique(),
            'group_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
