<?php

use yii\grid\GridView;

?>
<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'code', 'value' => 'code', 'options' => ['style' => ['width' => '50px']],],
        'system_name',
        'system_name',
        [
            'attribute' => 'is_enabled',
            'format' => 'html',
            'options' => ['style' => ['width' => '100px']],
            'value' => function($data) {
        return $data['is_enabled'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>';
    }
        ],
        [
            'attribute' => 'is_default',
            'format' => 'html',
            'options' => ['style' => ['width' => '100px']],
            'value' => function($data) {
        return $data['is_default'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>';
    }
        ],
    //['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>