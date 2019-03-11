<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 09.03.2019
 * Time: 0:48
 * @var \app\models\Activity $model
 */

?>

<h2>Событие стартует сегодня!!!</h2>
<strong><?=$model->title?></strong>
<p style="color: #761c19">Дата старта:<?=Yii::$app->formatter->asDatetime($model->timeStart);?></p>
