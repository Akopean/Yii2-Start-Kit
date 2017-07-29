<?php

use pendalf89\filemanager\assets\FilemanagerAsset;
use pendalf89\filemanager\Module;
use pendalf89\filemanager\models\Tag;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel pendalf89\filemanager\models\MediafileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['moduleBundle'] = FilemanagerAsset::register($this);

\backend\assets\AppAsset::register($this);
?>
<style>
    .list-view .items .item {
        margin: 5px 10px;
    }
    .list-view {
        float: none;
         width: auto;
    }
</style>

<div id="filemanager" data-url-info="<?= Url::to(['file/info']) ?>">

    <div class="page-content container-fluid">
        <header id="header"><span class="glyphicon glyphicon-picture"></span> <?= Module::t('main', 'File manager') ?></header>
        <div class="clear"></div>
        <div id="filemanager">
            <div id="toolbar">
                <div class="row">
                    <div class="col-md-9 col-sm-8">
                        <div class="btn-group offset-right">
                            <div class="row">
                                <div class="col-md-10 col-sm-9">
                                    <?php $searchForm = $this->render('_search_form', ['model' => $model]) ?>
                                    <?= ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'layout' => $searchForm . '<div class="items">{items}</div>{pager}',
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => function ($model, $key, $index, $widget) {
                                            return Html::a(
                                                Html::img($model->getDefaultThumbUrl($this->params['moduleBundle']->baseUrl))
                                                . '<span class="checked glyphicon glyphicon-check"></span>',
                                                '#mediafile',
                                                ['data-key' => $key]
                                            );
                                        },
                                    ]) ?>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <?= Html::a('<span class="glyphicon glyphicon-upload"></span> ' . Module::t('main', 'Upload manager'),
                                        ['file/uploadmanager'], ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="dashboard">
                            <div id="fileinfo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







