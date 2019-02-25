<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 24.02.2019
 * Time: 13:21
 */

namespace app\models;


use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $date_start;
    public $is_blocked;


    function rules()
    {
        return [
            ['title', 'string', 'max' => 150, 'min' =>2],
            [['title'], 'required'],
            ['is_blocked', 'boolean']
        ];
    }

    function attributeLabels(){
        return[
            'title'=> 'Заголовок активности',
            'description'=>'Описание',
            'is_blocked'=>'Блокирующее'
        ];
    }
}