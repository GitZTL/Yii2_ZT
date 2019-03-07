<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 03.03.2019
 * Time: 14:38
 */

namespace app\components;


use yii\base\Component;
use yii\data\Sort;
use yii\db\Exception;
use yii\db\Query;
use yii\log\Logger;

class DAOComponent extends Component
{

    /**
     * @return \yii\db\Connection
     */
    public function getDb(){
       return \Yii::$app->db;

    }

    public function getAllUsers(){
        $sql='select * from users';

        return $this->getDb()->createCommand($sql)->queryAll();
    }

    public function getActivityUser($id=2){

        $sql='select * from activity where user_id=:user';
        return $this->getDb()->createCommand($sql, [':user'=>(int)$id])->queryAll(); //безопасно, делать так!!!

    }

    public function getFirstActivity(){
        $sql='select * from activity limit 5';
        return $this->getDb()->createCommand($sql)->queryOne();//не зависимо от того, сколько записей вернется, выводим одну только
    }

    public function countNotificationActivity(){
        $sql='select count(id) from activity where use_notification=1'; //запрос агрегации
        return $this->getDb()->createCommand($sql)->queryScalar(); //т.к получим просто число
    }

    public function getAllActivityUser($id_user)
    {
        $query = new Query();

        return $query->select(['title', 'timeStart', 'email'])
            ->from('activity a')
            ->innerJoin('users u', 'a.user_id=u.id')
            ->andWhere(['a.user_id' => $id_user])//безопасный метод!!!
            ->andWhere('a.date_created<=:date', [':date' => date('Y-m-d H:i:s')])
            ->orderBy(['a.id' => SORT_DESC])
            ->limit(10)
            //->all(); //чтобы сделать запрос
           // ->createCommand()->sql; //вернет подготовленный запрос
            ->createCommand()->rawSql;//как выглядит с подставенными значениями
    }

    public function getActivityReader(){
        $sql='select * from users';

        return $this->getDb()->createCommand($sql)->query(); //получаем данные по-одному, оперируем как массивом
    }


    public function insertTest(){
        $trans=$this->getDb()->beginTransaction();
        try{
            $this->getDb()->createCommand()->insert('activity',[
                'user_id'=>2,
                'title'=>'title03',
                'timeStart'=>date('Y-m-d H:i:s')
            ])->execute();// все запросы, кот не селект идут через execute, вернет int

            //throw new \Exception('test');

            $this->getDb()->createCommand()->insert('activity',[
                'user_id'=>2,
                'title'=>'title04',
                'timeStart'=>date('Y-m-d H:i:s')
            ])->execute();

            $trans->commit();

        }catch (\Exception $e){
            \Yii::getLogger()->log($e->getMessage(),Logger::LEVEL_ERROR);
            $trans->rollBack();
        }


        //$this->getDb()->transaction(function(){ //2-й вар транзакции

        //});
    }



}