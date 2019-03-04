<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 04.03.2019
 * Time: 2:28
 */
?>


<div class="row">
    <div class="col-md-6">
        <h3>Авторизация</h3>
        <?php $form=\yii\bootstrap\ActiveForm::begin([

            'method'=> 'POST',
        ])?>

        <?=$form->field($model, 'email')?>
        <?=$form->field($model, 'password')->passwordInput()?>

        <div class="form-group">
            <button type="submit">Авторизоваться</button>
        </div>

        <?php \yii\bootstrap\ActiveForm::end()?>

    </div>
</div>