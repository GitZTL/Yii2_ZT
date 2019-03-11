<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 04.03.2019
 * Time: 18:54
 */

namespace app\controllers;


use yii\web\Controller;

class RbacController extends Controller
{
    public function actionGen(){ //будем вызывать url он будет формировать правила

        \Yii::$app->rbac->generateRbacRules();

    }
}