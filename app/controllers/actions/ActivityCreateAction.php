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
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ActivityCreateAction extends Action
{
    public $myName;

    public function run()
    {
        if(!\Yii::$app->rbac->canCreateActivity()){
            throw new HttpException(403, 'Увы, нет доступа к созданию. Совсем.');
        }
            $comp=\Yii::$app->activity;

            if(\Yii::$app->request->isPost)
            {
                /** @var ActivityComponent $comp*/
                    $activity=$comp->getModel(\Yii::$app->request->post());
                    //$activity->setScenario($activity::SCENARIO_CUSTOM);
                if(\Yii::$app->request->isAjax){
                    \Yii::$app->response->format=Response::FORMAT_JSON;

                    return ActiveForm::validate($activity);
                }


                    if($comp->createActivity($activity)) {
                        //return $this->controller->redirect(['/activity/view', 'id'=>$activity->id]);
                        return $this->controller->render('create_confirm', ['activity' => $activity]);
                    }

                //$activity->validate();
            }else{
                $activity=$comp->getModel();
            }

            //$activity->is_blocked=1;
            //$activity->title='Заголовок';


            return $this->controller->render('create', ['activity'=>$activity]);

    }
}