<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Menu');
$this->params['breadcrumbs'][] = $this->title;
echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);
?>
<div class="page-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'responsive'=>true,
        'hover'=>true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-duplicate"></i>' . Yii::t('backend', 'Menu') . '</h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('backend', 'Add New'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('backend', 'Reset Grid'), ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'],
                'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {link} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url,$model,$key) {
                        return Html::a(
                                '<i class="material-icons md-dark pmd-grid-icon">view_day</i> Builder',
                            Yii::$app->urlManager->createUrl('menu/'. $model->id .'/build'),
                            ['class' => 'btn-sm btn-success pull-right grid-button pmd-btn-raised pmd-ripple-effect']);
                    },
                    'update' => function ($url,$model,$key) {
                        return Html::a(
                            '<i class="material-icons md-dark pmd-grid-icon">mode_edit</i> Update',
                            Yii::$app->urlManager->createUrl('menu/'. $model->id) . '/update',
                            ['class' => 'btn-sm btn-primary pull-right edit grid-button pmd-btn-raised pmd-ripple-effect']);
                    },
                    'link' => function ($url,$model,$key) {
                        return Html::a(
                            '<i class="material-icons md-dark pmd-grid-icon">delete_forever</i> Delete',
                            Yii::$app->urlManager->createUrl('menu/'. $model->id .'/delete'),
                            ['class' => 'btn-sm btn-danger pull-right delete grid-button pmd-btn-raised pmd-ripple-effect']);
                    }
                ],
            ],

        ],
    ]); ?>
</div>