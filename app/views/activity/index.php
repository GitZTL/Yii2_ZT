<?php
/**
 * Created by PhpStorm.
 * User: вапр
 * Date: 05.03.2019
 * Time: 12:38
 */

?>

<div class="row">

    <div class="col-md-12">

        <?=\yii\grid\GridView::widget([

                'dataProvider'=> $provider,
                'tableOptions'=>[

                        'class'=>'table table-striped table-bordered table-hover'
                ],
                'rowOptions'=>function($model,$key,$index,$grid){
                    $class=$index%2?'odd':'even';

                    return [
                        'class'=>$class,
                        'index'=>$index,
                        'key'=>$key

                    ];
                },

                //'layout'=>"(pager)\n(items)\n(summary)\n(pager)"
                'columns'=>[
                     ['class'=>\yii\grid\SerialColumn::class],
                    'id',
                    [
                        'attribute'=>'title',
                        'label'=>'Меняем название поля',
                        'value'=>function($model){

                            return \yii\helpers\Html::a(\yii\bootstrap\Html::encode($model->title),['/activity/view','id'=>$model->id]);

                        },
                        'format'=> 'html'

                    ],

                    //'description:html:Новый заголовок',

                    'description',

                    [
                        'attribute'=> 'user_id',
                        'label'=>'email',
                        'value'=> function($model){
                           return $model->user->email;
                        }
                    ],
                    //[
                    //    'attribute'=>'user.email'
                    //]
                    //[
                     //       'label'=>'Добавляем нов название дата создания',
                     //   'attribute'=>'date_created',
                    //    'value'=> function($model){
                      //      return $model->getDate();

                     //   }
                    //]
                ]
            ]);?>
    </div>
</div>
