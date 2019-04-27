<?php

use yii\db\Migration;

/**
 * Class m190427_093307_create_group_tbl
 */
class m190427_093307_create_group_tbl extends Migration
{
    public function safeUp()
    {
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('group');
    }
}
