<?php

use common\models\Page;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */

AutocompleteAsset::register($this);


?>
<div class="panel">
    <div class="panel-heading new-setting">
        <hr>
        <h3 class="panel-title"><i class="voyager-plus"></i> New Setting</h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'settings/store']); ?>
        <div class="col-md-4">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="Default" class="control-label"><?= Yii::t('backend', 'Setting name: Admin Title') ?></label>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true],['class' => 'form-control']) ?>
                <span class="pmd-textfield-focused"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="Default" class="control-label"><?= Yii::t('backend', 'Setting key: admin_title') ?></label>

                <?= $form->field($model, 'key')->textInput(['maxlength' => true],['class' => 'form-control']) ?>
                <span class="pmd-textfield-focused"></span>
            </div>
        </div>
        <div class="col-md-4">
            <!--Simple select -->
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label><?= Yii::t('backend', 'Choose Type') ?></label>
                <?= $form->field($model, 'type')->dropDownList([
                    '' => '',
                    'text' => 'Text Box',
                    'text_area' => 'Text Area',
                    'checkbox' => 'Check Box',
                ],['class' => 'select-simple form-control pmd-select2']);?>
            </div>
        </div>
        <div style="clear:both"></div>
        <p class="submit">
            <button type="submit" class="btn btn-info pull-right new-setting-btn"><?= Yii::t( 'backend','Add New Setting') ?></button>
        </p>
        <div style="clear:both"></div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
