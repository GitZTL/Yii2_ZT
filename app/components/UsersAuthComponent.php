<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 04.03.2019
 * Time: 0:40
 */

namespace app\components;


use app\models\Users;
use yii\base\Component;

class UsersAuthComponent extends Component
{

        public function getModel($params=null){
        $model= new Users();

        if($params){
            $model->load($params);

        }

        return $model;
    }


    /**
     * @param $model Users
     * @return bool
     */

    public function loginUser(&$model):bool{
        $user=$this->getUserByEmail($model->email);

        if(!$user){
            $model->addError('email', 'Такого пользователя не существует!');
            return false;
        }

        if(!$this->validatePassword($model->password, $user->password_hash)){

            $model->addError('password','Пароль неверный!!!');
            return false;
        }

        $user->username=$user->email; //переопределяем во время авторизации
        return \Yii::$app->user->login($user);
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    private function validatePassword($password,$hash){

        return \Yii::$app->security->validatePassword($password,$hash);

    }

    /**
     * @param $email
     * @return array|\yii\db\ActiveRecord
     */
    public function getUserByEmail($email){

        return $this->getModel()::find()->andWhere(['email'=>$email])->one();

    }


       /**
        * @param $model Users
        * @return bool
        */

        public function createNewUser(&$model):bool{ //получаем модель пользователя по ссылке
            if(!$model->validate(['password', 'email'])) {

                return false;
            }

            $model->password_hash=$this->hashPassword($model->password);

            //if(!$model->validate()){
            //   return false;
            //}
            if($model->save()){
                return true;
            } //сохраняем в БД  true false (save неявно вызывает САМ валидацию!!!)

                return false;
        }

        private function hashPassword($password){

            return \Yii::$app->security->generatePasswordHash($password);

        }
}