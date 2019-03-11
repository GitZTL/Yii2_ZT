<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 05.03.2019
 * Time: 12:03
 */

namespace app\models;


use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity
{
    public function getDataProvider(){
        $query=Activity::find();// получаем объект класса query из сущности activity

        $provider=new ActiveDataProvider(
           [
               'query'=>$query,
               'pagination'=>[
                   'pageSize'=>5
               ],
               'sort'=>[
                   'defaultOrder'=>
                   [
                       'timeStart'=>SORT_DESC
                   ]
               ]
           ]);//создаем provider

        /** вернет масси моделей для текущей страницы */
        $provider->getModels();
        $provider->getTotalCount(); //сколько всего элементов
        $provider->count; //сколько эл-тов на стр
        $provider->getKeys(); //вернет массив id моделей текущей страницы


        //$query->andFilterWhere(['user_id'=>2]);


        return $provider;
    }
}