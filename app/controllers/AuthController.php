<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 04.03.2019
 * Time: 0:36
 */

namespace app\controllers;


use app\components\UsersAuthComponent;
use yii\web\Controller;

class AuthController extends Controller
{

    public function actionSignIn(){
        /** @var UsersAuthComponent $comp */
        $comp=\Yii::$app->auth;

        $model=$comp->getModel(\Yii::$app->request->post());

        if(\Yii::$app->request->isPost){

            if($comp->loginUser($model)){
                return $this->redirect(['/activity/create']);
            }

        }

        return $this->render('signin', ['model'=>$model]);
    }



    public function actionSignUp(){
        /** @var UsersAuthComponent $comp */
        $comp=\Yii::$app->auth;

        $model=$comp->getModel(\Yii::$app->request->post());

            if(\Yii::$app->request->isPost){
                //это уже бизнес-логика, должны вызвать метод компонента
                if($comp->createNewUser($model)){
                    \Yii::$app->session->addFlash('success', 'Польщователь успешно добавлен Id ' .$model->id);
                    return $this->redirect(['/']);  //redirect на главную страницу
                }
            }

        return $this->render('signup',['model'=>$model]);
    }
}