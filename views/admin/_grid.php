<?php

use yii\grid\GridView;

?>
<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'code',
        // 'is_default',
        // 'is_enabled',
        'system_name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>