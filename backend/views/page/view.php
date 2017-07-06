<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $attributes = [
        [
            'group'=>true,
            'label'=> Yii::t('backend', 'SECTION 1: Identification Information'),
            'rowOptions'=>['class'=>'info']
        ],
        [
            'attribute'=>'title',
            'format'=>'raw',
            'type'=>DetailView::INPUT_TEXT,
            'valueColOptions'=>['style'=>'width:30%']
        ],
        [
            'attribute'=>'slug',
            'format'=>'raw',
            'type'=>DetailView::INPUT_TEXT,
            'valueColOptions'=>['style'=>'width:30%']
        ],
        [
            'attribute'=>'author_id',
            'format'=>'raw',
            'value'=> \common\models\User::findOne($model->author_id)->username,
            'type'=>DetailView::INPUT_TEXT,
            'widgetOptions'=>[
                'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
            ],
            'valueColOptions'=>['style'=>'width:30%']
        ],
        [
            'attribute'=>'date',
            'format'=>'date',
            'type'=>DetailView::INPUT_DATE,
            'widgetOptions' => [
                'pluginOptions'=>['format'=>'yyyy-mm-dd']
            ],
            'valueColOptions'=>['style'=>'width:30%']
        ],
        [
            'attribute'=>'status',
            'label'=> Yii::t('backend', 'Available?'),
            'format'=>'raw',
            'value'=>$model->status ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
            'type'=>DetailView::INPUT_SWITCH,
            'widgetOptions' => [
                'pluginOptions' => [
                    'onText' => 'Yes',
                    'offText' => 'No',
                ]
            ],
            'valueColOptions'=>['style'=>'width:30%']
        ],
        [
            'group'=>true,
            'label'=>Yii::t('backend', 'SECTION 2: Content Information'),
            'rowOptions'=>['class'=>'info']
        ],
        [
            'attribute'=>'content',
            'format'=>'raw',
            'value'=>'<span class="text-justify"><em>' . Html::encode($model->content) . '</em></span>',
            'type'=>DetailView::INPUT_TEXTAREA,
            'options'=>['rows'=>4]
        ]
    ];

    echo DetailView::widget([
        'model' => $model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'attributes' => $attributes,
    ]) ?>

</div>
