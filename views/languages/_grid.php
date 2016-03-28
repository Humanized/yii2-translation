<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>
<?=

GridView::widget([
//    'caption' => 'Language Settings',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'code', 'value' => 'code', 'options' => ['style' => ['width' => '50px']],],
        'system_name',

        [
            'class' => 'yii\grid\ActionColumn',

                    'template' => '{update}'
                ],
            ],
        ]);
?>