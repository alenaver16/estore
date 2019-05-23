<?php

use yii\db\Migration;

/**
 * Class m190520_173056_add_users_field
 */
class m190520_173056_add_users_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'city', $this->string(40));
        $this->addColumn('user', 'country', $this->string(40));
        $this->addColumn('user', 'address', $this->string(40));
        $this->addColumn('user', 'postcode', $this->string(40));
        $this->addColumn('user', 'note', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'city');
        $this->dropColumn('user', 'country');
        $this->dropColumn('user', 'address');
        $this->dropColumn('user', 'postcode');
        $this->dropColumn('user', 'note');
    }

}
