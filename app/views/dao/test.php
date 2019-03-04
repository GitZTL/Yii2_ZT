<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 03.03.2019
 * Time: 14:34
 */

?>


<div class="row">

    <div class="col-md-6">
        <pre>
            <?=print_r($users);?>
        </pre>

    </div>

    <div class="col-md-6">
        <pre>
            <?=print_r($activityUser)?>
        </pre>
    </div>

    <div class="col-md-6">
        <pre>
            <?=print_r($firstActivity)?> //вернется просто массив, а не массив массивов
        </pre>
    </div>

    <div class="col-md-6">
        <pre>
            <?='кол-во активностей, требующих уведомления: '.$countNotification?>
        </pre>
    </div>

    <div class="col-md-6">
        <pre>
            <?=print_r($allActivityUser)?>
        </pre>
    </div>

    <div class="col-md-6">
        <pre>
            <?php foreach($activityReader as $item):?>
            <?=print_r($item)?>
            <?php endforeach;?>
        </pre>
    </div>


</div>