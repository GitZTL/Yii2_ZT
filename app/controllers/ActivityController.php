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
use app\controllers\actions\ActivityIndexAction;
use app\models\Activity;
use yii\web\Controller;
use yii\web\HttpException;

class ActivityController extends BaseController
{
    public function actions(){

        return [
            'create'=>[
                'class'=>ActivityCreateAction::class, 'myName'=> 'Татьяна'
            ],
            //'test'=>ActivityCreateAction::class
            'index'=>[
                'class'=>ActivityIndexAction::class
            ]

        ];

    }

   // public function beforeAction($action)
   // {
    //   if(\Yii::$app->user->isGuest){
      //     throw new HttpException(401, 'No access, absolutely!!!');
      // }

     //  return parent::beforeAction($action);
   // }

    public function actionView($id){

        //\Yii::$app->request->LogMeHere();
        $comp=\Yii::$app->activity;

        $activity=$comp->getActivity($id);

        if(!$activity){
            throw new HttpException(401,'Activity not found. At all!');
        }

        if(!\Yii::$app->rbac->canViewEditAll()){
            if(!\Yii::$app->rbac->canViewActivity($activity)){
                throw new HttpException(403,'no access to view this activity');
            }
        }



            return $this->render('create_confirm',['activity'=>$activity]);
    }

}