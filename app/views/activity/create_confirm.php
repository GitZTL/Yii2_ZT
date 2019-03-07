<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 27.02.2019
 * Time: 12:56
 */


use yii\helpers\Html;

?>
    <h3>Были отправлены следующие данные:</h3>
        <ul>
            <li><label>Заголовок активности</label>: <?=Html::encode($activity->title)?></li>
            <li><label>Описание активности</label>: <?=Html::encode($activity->description)?></li>
            <li><label>Email</label>: <?=Html::encode($activity->email)?></li>
            <li><label>Дата начала события</label>: <?=Html::encode($activity->date_start)?></li>
            <li><label>Блокирующие</label>: <?=Html::encode($activity->is_blocked?'Да':'Нет')?></li>


        </ul>

    <?=Html::a('Создать еще одну активность', ['/activity/create'], ['class'=>'btn btn-default'])?>




