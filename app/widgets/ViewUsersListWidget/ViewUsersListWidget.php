<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 05.03.2019
 * Time: 11:33
 */

namespace app\widgets\ViewUsersListWidget;


use mysql_xdevapi\Exception;
use yii\bootstrap\Widget;

class ViewUsersListWidget extends Widget
{
    public $users;


    public function init(){
        parent::init();

        if(empty($this->users)){
            throw new \Exception('need param users');
        }
    }

    public function run(){
        return $this->render('index',['users'=>$this->users]);
    }
}