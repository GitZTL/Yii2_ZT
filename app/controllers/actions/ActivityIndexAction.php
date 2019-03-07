<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 05.03.2019
 * Time: 12:29
 */

namespace app\controllers\actions;


use app\components\ActivityComponent;
use yii\base\Action;

class ActivityIndexAction extends Action
{
    public function run(){
        /** @var ActivityComponent $comp */
        $comp=\Yii::$app->activity;

        $dataprovider=$comp->getSearchProvider(\Yii::$app->request->queryParams);

        return $this->controller->render('index',['provider'=>$dataprovider]);
    }
}