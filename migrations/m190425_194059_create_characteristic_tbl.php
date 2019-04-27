<?php

use yii\db\Migration;

/**
 * Class m190425_194059_create_characteristic_tbl
 */
class m190425_194059_create_characteristic_tbl extends Migration
{
    public function safeUp()
    {
        $this->createTable('characteristic', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull()->unique(),
            'description' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('characteristic');
    }
}
