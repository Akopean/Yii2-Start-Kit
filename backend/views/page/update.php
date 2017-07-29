<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Update');

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Page'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->translate('title'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);
?>
<div class="page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
