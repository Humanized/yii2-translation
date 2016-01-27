<?php
/* @var $this yii\web\View */
/* @var $searchModel humanized\translation\models\LanguageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Translations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-index">

    <div class="row">
        <aside class="col-md-4">
            <div class="well">
                <blockquote><span class="glyphicon glyphicon-bullhorn"></span> System Translation</blockquote>
                <?= $this->render('_aside') ?>
            </div>

        </aside>

        <div class="col-md-8">
            <?=
            $this->render('_grid', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel
            ])
            ?>
        </div>

    </div>

</div>