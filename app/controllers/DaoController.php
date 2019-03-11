<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 03.03.2019
 * Time: 14:29
 */

namespace app\controllers;


use app\base\BaseController;
use app\components\DAOComponent;
use yii\filters\PageCache;

class DaoController extends BaseController
{

    public function behaviors()
    {
        return [
            ['class'=>PageCache::class,
                'only'=>['test'],
                'duration'=>10]
        ];
    }


    public function actionTest(){

        /** @var DAOComponent $dao */
        $dao=\Yii::$app->dao;

        $dao->insertTest();

        $users=$dao->getAllUsers();
        $activityUser=$dao->getActivityUser();
        $firstActivity=$dao->getFirstActivity();
        $countNotification=$dao->countNotificationActivity();
        $allActivityUser=$dao->getAllActivityUser(1);
        $activityReader=$dao->getActivityReader();

        return $this->render('test',['users' => $users,'activityUser'=>$activityUser,
            'firstActivity'=>$firstActivity, 'countNotification'=>$countNotification,
            'allActivityUser'=>$allActivityUser, 'activityReader'=>$activityReader]);
    }


    public function actionCache(){
        \Yii::$app->cache->set('key1', 'value1');

        \Yii::$app->cache->delete('key1');
        //$value=\Yii::$app->cache->get('key1');

        \Yii::$app->cache->flush();//удалит все

        $value=\Yii::$app->cache->getOrSet('key1', function (){
            return 'value3';
        });


        


        echo $value;
    }
}