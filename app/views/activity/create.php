<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 24.02.2019
 * Time: 13:08
 */
/* @var $activity \app\models\Activity
 */
use yii\bootstrap\ActiveForm;
?>

<div class="row">
    <div class="col-md-6">
        <h2>Создание новой активности</h2>
        <?=Yii::getAlias('@webroot')?>
        <?php $form=ActiveForm::begin();?>
        <?=$form->field($activity, 'title');?>
        <?=$form->field($activity, 'description')->textarea();?>
        <?=$form->field($activity, 'is_blocked')->checkbox();?>

        <div class="form-group">
            <button type="submit" class="btn btn-default">Отправить</button>
        </div>

        <?php ActiveForm::end();?>

    </div>
</div>