<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive'=>true,
        'hover'=>true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-duplicate"></i> Pages</h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Page', ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'slug',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute' => 'status',
                'vAlign' => 'middle'
            ],
            [
                'class'=>'kartik\grid\ActionColumn',
                //'dropdownOptions'=>['class'=>'pull-right'],
                'viewOptions'=>['title'=>'This will launch the book details page. Disabled for this demo!', 'data-toggle'=>'tooltip'],
                'updateOptions'=>['title'=>'This will launch the book update page. Disabled for this demo!', 'data-toggle'=>'tooltip'],
                'deleteOptions'=>['title'=>'This will launch the book delete action. Disabled for this demo!', 'data-toggle'=>'tooltip'],
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],
        ],
    ]); ?>
</div>
