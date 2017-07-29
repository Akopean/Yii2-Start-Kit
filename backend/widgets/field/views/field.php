<?php

use yii\web\View;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \yii\base\Model */
/* @var $fields \backend\widgets\field\FormFieldWidget */
/* @var $action \backend\widgets\field\FormFieldWidget */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="panel">
    <div class="panel-heading new-setting">
        <hr>
        <h3 class="panel-title"><?= Yii::t('backend', 'New Setting') ?></h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['method' => 'post', 'action' => ($action === null ?  '' : $action)]); ?>
        <div class="col-md-4">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="Default" class="control-label"></label>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                <span class="pmd-textfield-focused"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="Default" class="control-label"><?= Yii::t('backend', 'Setting key:') ?> admin_title</label>
                <?= $form->field($model, 'key')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                <span class="pmd-textfield-focused"></span>
            </div>
        </div>
        <div class="col-md-4">
            <!--Simple select -->
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label><?= Yii::t('backend', 'Choose Type') ?></label>
                <?= $form->field($model, 'type')->dropDownList(is_array($fields) ? $fields : [], ['class' => 'select-simple form-control pmd-select2']);?>
            </div>
        </div>
        <div class="col-md-12">
            <!-- Propeller Accordion example -->
            <div class="panel-group pmd-accordion" id="accordion7" role="tablist" aria-multiselectable="true" >
                <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion7" href="#collapseThree7" aria-expanded="false" aria-controls="collapseThree7"  data-expandable="false">
                                Only: dropdown box or radio button
                                <i class="material-icons md-dark pmd-sm pmd-accordion-arrow">keyboard_arrow_down</i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <div class="new-settings-options">
                                <!-- Normal Textarea -->
                                <div class="form-group pmd-textfield">
                                    <?= $form->field($model, 'details')->textArea(
                                        [
                                            'rows' => 6,
                                            'class' => 'form-control code-field',
                                            'placeholder' =>
'{
    "default" : "radio1",
    "options" : {
    "radio1": "Radio Button 1 Text",
    "radio2": "Radio Button 2 Text"
    }
}']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Propeller Accordion example end-->
        </div>
        <p class="submit">
            <button type="submit" class="btn btn-info pull-right new-setting-btn"><?= Yii::t( 'backend','Add New Setting') ?></button>
        </p>
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
    View::POS_READY,
    'my-button-handler'
);



