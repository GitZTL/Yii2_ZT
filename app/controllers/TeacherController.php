<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 24.02.2019
 * Time: 3:15
 */

namespace app\controllers;


use app\base\BaseController;
use yii\web\Controller;

class TeacherController extends BaseController
{
    public function actionStudent(){
        \yii::$app->session->setFlash('error', 'Какой-то странный текст');
        $framework ='Yii2';
        return $this->render('student',['fram'=>$framework]);
    }
}