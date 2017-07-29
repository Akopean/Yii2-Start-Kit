<?php

use common\models\Page;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */
/* @var $form yii\widgets\ActiveForm */

AutocompleteAsset::register($this);

?>
<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="page-form">
            <?php $form = ActiveForm::begin(); ?>

            <div class="panel-body">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="panel-body">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
