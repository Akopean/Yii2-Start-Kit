<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Create Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);
?>
<div class="page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
