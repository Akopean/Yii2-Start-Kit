<?php

use yii\web\View;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\MenuItem */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="panel">
    <div class="panel-heading new-setting">
        <hr>
        <h3 class="panel-title"><i class="voyager-plus"></i>Create a New Menu Item</h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'create-item']); ?>
        <div class="col-md-6 col-lg-3">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="Default" class="control-label"><?= Yii::t('backend', 'Menu Item Name') ?></label>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                <span class="pmd-textfield-focused"></span>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="Default" class="control-label"><?= Yii::t('backend', 'Menu Item Url') ?></label>

                <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                <span class="pmd-textfield-focused"></span>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="Default" class="control-label"><?= Yii::t('backend', 'Font Icon class for the Menu Item') ?> <a
                            href="https://material.io/icons/"
                            target="_blank">Material Icons</a></label>
                <?= $form->field($model, 'icon_class')
                    ->textInput(['maxlength' => true, 'class' => 'form-control'])
                    ->label(Yii::t('backend', 'Icon Name') . ' (date_range, code)') ?>
                <span class="pmd-textfield-focused"></span>
            </div>
        </div>
        <div class="col-md-6 col-lg-2">
            <!--Simple select -->
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label><?= Yii::t('backend', 'Open In') ?></label>
                <?= $form->field($model, 'target')->dropDownList([
                    'self' => 'Current Window',
                    'new' => 'New Window',
                ],['class' => 'select-simple form-control pmd-select2']);?>
            </div>
        </div>
        <p class="submit">
            <button type="submit" class="btn btn-info pull-right new-setting-btn"><?= Yii::t( 'backend','New Menu Item') ?></button>
        </p>
        <div style="clear:both"></div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs(
// Propeller Select2
    "
        jQuery(document).ready(function () {
            jQuery('.select-simple').select2({
                theme: 'bootstrap',
                minimumResultsForSearch: Infinity,
            });
        });",
    View::POS_READY
);
