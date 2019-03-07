<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 04.03.2019
 * Time: 18:53
 */

namespace app\components;


use app\models\rules\ViewActivityOwnerRule;
use yii\base\Component;

class RbacComponent extends Component
{
    /**
     * @return \yii\rbac\ManagerInterface
     */

    public function getAuthManager(){
        return \Yii::$app->authManager;
    }

    public function generateRbacRules(){
        $authManager=$this->getAuthManager();

        $authManager->removeAll();//чтобы не дублировать, т.е. каждый раз очищаем и заново генерируем

        $admin=$authManager->createRole('admin');
        $user=$authManager->createRole('user');

        $authManager->add($admin);
        $authManager->add($user);

        $createActivity=$authManager->createPermission('createActivity');
        $createActivity->description='Создание активности';

        $viewOwnerRule=new ViewActivityOwnerRule();//объявляем правило
        $authManager->add($viewOwnerRule);//добавляем правило в базу, оно обособлено ни к чему не привязывается

        $viewActivity=$authManager->createPermission('viewActivity');
        $viewActivity->description='Просмотр активности';
        $viewActivity->ruleName=$viewOwnerRule->name;

        $viewEditAll=$authManager->createPermission('viewEditAll'); //для админа
        $viewEditAll->description='Просмотр и редактирование всех активностей';

        $authManager->add($createActivity);
        $authManager->add($viewActivity);
        $authManager->add($viewEditAll);

        $authManager->addChild($user,$createActivity); //раздаем разрешения ролям
        $authManager->addChild($user,$viewActivity);

        $authManager->addChild($admin,$user);//наследуется от юзер, т.е. может все что может юзер
        $authManager->addChild($admin,$viewEditAll);

        $authManager->assign($user, 3); //даем конкретному пользователю конкретную роль
        $authManager->assign($admin, 6);
    }

    /**
     * @return bool
     */
    public function canCreateActivity(){
       return \Yii::$app->user->can('createActivity');
    }

    public function canViewEditAll(){
        return \Yii::$app->user->can('viewEditAll');
    }

    public function canViewActivity($activity):bool{
        return \Yii::$app->user->can('viewActivity',['activity'=>$activity]);
    }

}