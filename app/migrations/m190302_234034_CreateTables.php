<?php

use yii\db\Migration;

/**
 * Class m190302_234034_CreateTables
 */
class m190302_234034_CreateTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(), //сразу задается как цельночисленное, первичный ключ, автоинкремент
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text(),
            'timeStart'=>$this->dateTime()->notNull(),
            'timeEnd'=>$this->dateTime(),
            'use_notification'=>$this->boolean()->notNull()->defaultValue(0),//в mysql  нет типа boolean
            'is_blocked'=>$this->boolean()->notNull()->defaultValue(0),
            'is_repeated'=>$this->boolean()->notNull()->defaultValue(0),
            'date_created'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), //в любой таблице лучше добавлять это поле

            ]);

        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(150)->notNull(),
            'password_hash'=>$this->string(300)->notNull(),
            'token'=>$this->string(150),
            'fio'=>$this->string(150),
            'date_create'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
   }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');


        //echo "m190302_234034_CreateTables cannot be reverted.\n";
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190302_234034_CreateTables cannot be reverted.\n";

        return false;
    }
    */
}
