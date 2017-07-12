<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);
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
            'attribute'=>'name',
            'format'=>'raw',
            'type'=>DetailView::INPUT_TEXT,
            'valueColOptions'=>['style'=>'width:30%']
        ],
    ];

    echo DetailView::widget([
        'model' => $model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'attributes' => $attributes,
    ]) ?>

</div>
