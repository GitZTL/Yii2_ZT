<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 07.03.2019
 * Time: 14:19
 */

namespace app\behaviours;


use yii\base\Behavior;
use yii\log\Logger;

class LogMyBehaviour extends Behavior
{
    public function logMeHere(){
        \Yii::getLogger()->log('log behaviour!!', Logger::LEVEL_INFO);
    }
}