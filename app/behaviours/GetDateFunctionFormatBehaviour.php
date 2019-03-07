<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 07.03.2019
 * Time: 13:50
 */

namespace app\behaviours;


use yii\base\Behavior;

class GetDateFunctionFormatBehaviour extends Behavior
{

    public $attribute_name;
    public function getDate(){
        $date=$this->owner($this->attribute_name);

        return \Yii::$app->formatter->asDate($date);

    }
}