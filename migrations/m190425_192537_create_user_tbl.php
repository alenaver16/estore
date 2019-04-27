<?php

use yii\db\Migration;

/**
 * Class m190425_192537_create_user_tbl
 */
class m190425_192537_create_user_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(40)->notNull()->unique(),
            'first_name' => $this->string(40),
            'last_name' => $this->string(40),
            'email' => $this->string(40)->notNull()->unique(),
            'phone' => $this->string(20)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
