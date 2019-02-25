<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 25.02.2019
 * Time: 0:51
 */

namespace app\controllers\actions;


use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\base\Model;

class ActivityCreateAction extends Action
{
    public $myName;

    public function run(){


            //$activity = new Activity();
            //$activity=\Yii::$app->activity->getModel(\Yii::$app->request->post());
            //echo $this->myName; exit;



            if(\Yii::$app->request->isPost){
                /** @var ActivityComponent $comp*/
                $comp=\Yii::$app->activity;
                $activity=$comp->getModel(\Yii::$app->request->post());
                $comp->createActivity($activity);

                //$activity->validate();
            }else{
                $activity=\Yii::$app->activity->getModel();
            }


            //$activity->title='Заголовок';


            return $this->controller->render('create', ['activity'=>$activity]);

    }
}