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
            // 'context' => $this->context,
            'buttons' => [

                'update' => function ($url, $model) {

                    $glyph = 'glyphicon-star';
                    if ($model->is_default) {
                        $glyph = 'glyphicon-asterisk';
                    } else {
                        $glyph .=!$model->is_enabled ? '-empty' : '';
                    }

                    $linkOptions = [
                        'title' => \Yii::t('yii', $model->is_enabled ? 'Disable' : 'Enable'),
                        'data-method' => 'post',
                        'data-pjax' => '0',
                        'style' => $model->is_default ? [ 'pointer-events' => 'none', 'cursor' => 'pointer'] : []
                    ];




                    return Html::a('<span class="glyphicon ' . $glyph . '"></span>', ['update', 'id' => $model['code']], $linkOptions);
                }
                    ],
                    'template' => '{update}'
                ],
            ],
        ]);
?>