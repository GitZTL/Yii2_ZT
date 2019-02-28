<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 25.02.2019
 * Time: 2:22
 */

namespace app\components;


use yii\base\Component;

class ActivityComponent extends Component
{
    public $activity_class;

    public function getModel($params=null){
        $model= new $this->activity_class;

        if($params && is_array($params)){

            $model->load($params);
        }

        return $model;
    }

    public function createActivity(&$model):bool{

        if ($model->validate()) {

            $path = $this->getPathSaveFile();
            $name = mt_rand(0, 999) . time() . '.' . $model->image->getExtension();
            $model->image->saveAs($path.$name);

            if (!$model->image->saveAs($path . $name)) {
                $model->addError('image', 'Неудачная попытка переместить файл');
                return false;
            }
            //$model->image=$name;
            return true;

        }
    }

        private function getPathSaveFile()
        {

            return \Yii::getAlias('@app/files/');
        }

}