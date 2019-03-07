<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 05.03.2019
 * Time: 11:43
 */

?>


<div class="col-md-6">
        <pre>
            <?php foreach ($users as $user):?>
            <?=\yii\helpers\VarDumper::dump($user);?>
            <?php endforeach;?>
        </pre>

</div>

