<?php

namespace humanized\translation\widgets\grid\assets;

class GridViewAsset extends \yii\web\AssetBundle
{

    public $js = [
        'js/grid.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->sourcePath = \Yii::getAlias('@vendor') . '/humanized/yii2-translation/assets';
        parent::init();
    }

}
