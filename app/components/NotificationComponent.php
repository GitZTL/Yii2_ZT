<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 09.03.2019
 * Time: 0:32
 */

namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\mail\MailerInterface;

class NotificationComponent extends Component
{

    /** @var MailerInterface */
    public $mailer;


    /**
     * @param $activities Activity[]
     * @return \Generator
     */
    public function sendTodayNotification($activities){
        foreach($activities as $activity){
            $result=$this->mailer->compose('notification',['model'=>$activity])
            ->setFrom('ivankot@yandex.ru')
            ->setTo(['kormun@yandex.ru','ivankot@yandex.ru'])
            ->setSubject('Важное событие сегодня')
            ->setCharset('utf-8')
                //->attach(\Yii::getAlias('@app/web/images'))
            ->send();

       yield ['result'=>$result,'email'=>user->email];

        }

    }
}