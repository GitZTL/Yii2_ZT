<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 08.03.2019
 * Time: 23:18
 */

namespace app\commands;


use app\components\NotificationComponent;
use yii\console\Controller;
use yii\helpers\Console;

class NotificationController extends Controller
{

    public $param;


    public function optionAliases()
    {
        return ['p'=>'param'];
    }

    public function options($actionID)//переопределяем функцию
    {
        return ['param'];
    }

    public function actionParams(){

        echo 'param='.$this->param.PHP_EOL;

    }


    public function actionIndex(...$args){  //$param=null
        echo $this->ansiFormat('привет! я консольное приложение'.PHP_EOL, Console::BG_GREEN);

        echo 'param:  '.print_r($args).PHP_EOL;
    }



    public function actionNotification(){
        $activities=\Yii::$app->activity->getActivityToday();

        /** @var NotificationComponent $notif_comp */
        $notif_comp=\Yii::createObject(['class'=>NotificationComponent::class,
            'mailer'=>\Yii::$app->mailer]);

        foreach ($notif_comp->sendTodayNotification($activities) as $result){
            if($result['result']){
                echo $this->ansiFormat('Успешно отправлено письмо на почту: '.$result['email'],Console::FG_GREEN);
            }else{
                echo $this->ansiFormat('Ошибка отправки письма на почтуЖ '.$result['email'],Console::FG_RED);
            }
        };
    }



}