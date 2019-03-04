<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 28.02.2019
 * Time: 0:06
 */

namespace app\models\rules;


use yii\validators\Validator;

class NotAdminRule extends Validator
{
    public function validateAttribute($model, $attribute)
    {
            if($model->$attribute=='admin'){
            $model->addError($attribute, 'Заголовок события не должен быть '.$model->$attribute);
        }
    }
}