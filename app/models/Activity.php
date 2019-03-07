<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 24.02.2019
 * Time: 13:21
 */

namespace app\models;


use app\behaviours\GetDateFunctionFormatBehaviour;
use app\models\rules\NotAdminRule;
use yii\base\Model;
use yii\web\UploadedFile;

class Activity extends ActivityBase
{

    public function behaviors()
    {
        return [
            [
                'class'=>GetDateFunctionFormatBehaviour::class,
                'attribute_name'=>'date_created'
            ]
        ];
    }

    //public $title;
    //public $description;
    public $date_start;
    //public $is_blocked;
    //public $is_repeated;

    public $email;
    public $email_repeat;
    //public $use_notification;
    //public $as_repeat;

    public $image;


    //const SCENARIO_CUSTOM='custom_sc';



    public function beforeValidate()
    {
        $this->loadFile();
        if(!empty($this->date_start)){

            $this->date_start=\DateTime::createFromFormat('d.m.Y.',$this->date_start);

           if($this->date_start){
                $this->date_start=$this->date_start->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }

    public function loadFile(){

        $this->image=UploadedFile::getInstance($this, 'image');

    }

    public function rules()
    {
        return array_merge([
            ['title', 'string', 'max' => 150, 'min' =>2],
            [['title'], 'required'],
            ['title','trim'],
            ['title', 'notAdmin'],
            //['title', NotAdminRule::class],
            //['title', NotAdminRule::class, 'on'=>self::SCENARIO_CUSTOM],
            [['is_blocked', 'use_notification'], 'boolean'],
            ['is_repeated', 'boolean'],//флаг повторяющегося события
            ['email', 'email'],
            ['email', 'required','when'=>function($model){
                return $model->use_notification?true:false;
            }, 'message'=>'Поле email должно быть обязательно заполнено!'],
            ['email_repeat', 'compare', 'compareAttribute'=>'email', 'message'=>'email должен совпадать с полем выше!'], //'compareValue'=>'20';
            ['date_start', 'date', 'format'=> 'php:Y-m-d', 'message'=>'Формат даты должен быть dd.mm.yyyy'],
            ['as_repeat', 'in', 'range'=> [0,1,2,3]],
            ['image', 'file', 'extensions'=>['jpg','png','img']],
        ],parent::rules());
    }


   public function notAdmin($attribute,$value){
        if($this->$attribute=='admin'){
           $this->addError($attribute, 'Заголовок события не должен быть '.$this->$attribute);
        }
    }

    public function attributeLabels(){
        return[
            'title'=> 'Заголовок активности',
            'description'=>'Описание',
            'email'=>'Электронная почта',
            'date_start'=>'Дата начала события',
            'is_blocked'=>'Блокирующее',
            'is_repeated'=>'Повторяющееся',
            'as_repeat'=>'Частота повторений',
            'email_repeat'=>'Повторите email',
            'use_notification'=>'Я хочу прлучать уведомления',
            'image'=>'Выберите изображение',
        ];
    }
}