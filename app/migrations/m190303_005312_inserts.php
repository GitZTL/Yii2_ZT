<?php

use yii\db\Migration;

/**
 * Class m190303_005312_inserts
 */
class m190303_005312_inserts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', ['id'=>1, 'email'=>'somemail@mail.com', 'password_hash'=>'1111',
            'fio'=>'f i o']);
        $this->insert('users', ['id'=>2, 'email'=>'mailtwo@mail.com', 'password_hash'=>'2222',
            'fio'=>'f2 i2 o2']);

        $this->batchInsert('activity', [
            'title', 'timeStart', 'user_id', 'use_notification'
        ],
        [
            ['Title 1', date('Y-m-d H:i:s'),1,0],
            ['Title 1_1', date('Y-m-d H:i:s'),1,0],
            ['Title 1_2', date('Y-m-d H:i:s'),1,0],
            ['Title 1_3', date('Y-m-d H:i:s'),1,1],

            ['Title 2', date('Y-m-d H:i:s'),2,0],
            ['Title 2_1', date('Y-m-d H:i:s'),2,0],
            ['Title 2_2', date('Y-m-d H:i:s'),2,1],
            ['Title 2-3', date('Y-m-d H:i:s'),2,0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190303_005312_inserts cannot be reverted.\n";

        return false;
    }
    */
}
