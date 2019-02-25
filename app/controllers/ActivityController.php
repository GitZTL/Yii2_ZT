<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 24.02.2019
 * Time: 11:52
 */

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;
use app\models\Activity;
use yii\web\Controller;

class ActivityController extends BaseController
{
    public function actions(){

        return [
            'create'=>['class'=>ActivityCreateAction::class, 'myName'=> 'Татьяна']
            //'test'=>ActivityCreateAction::class
        ];
    }
}