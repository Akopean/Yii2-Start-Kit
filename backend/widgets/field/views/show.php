<?php

use pendalf89\filemanager\widgets\FileInput;
use pendalf89\filemanager\widgets\TinyMce;
use yii\web\View;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \yii\base\Model */
/* @var $action \backend\widgets\field\FormFieldWidget */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="panel">
    <?php $form = ActiveForm::begin(['action' => ($action === null ?  '' : $action), 'method'  => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php foreach($model as $field): ?>
            <div class="panel-heading">
                <h3 class="panel-title">
                    <code>Yii::$app->settings->get('<?= $field->key?>')</code>
                </h3>
                <div class="panel-actions">
                    <a href="<?= Yii::$app->urlManager->createUrl('settings/move-down/'. $field->id)?>">
                        <i class="material-icons md-dark pmd-sm">keyboard_arrow_down</i>
                        <i class="sort-icons voyager-sort-asc"></i>
                    </a>
                    <a href="<?= Yii::$app->urlManager->createUrl('settings/move-up/'. $field->id)?>">
                        <i class="material-icons md-dark pmd-sm">keyboard_arrow_up</i>
                        <i class="sort-icons voyager-sort-desc"></i>
                    </a>
                    <i class="material-icons md-dark pmd-sm delete-action" data-target="#delete-dialog" data-id="<?= $field->id ?>" data-toggle="modal">delete</i>
                </div>
            </div>
            <div class="panel-body">
                <?php if($field->type == "text"):?>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label for="Default" class="control-label"><?= $field->name ?></label>
                        <input name="<?= $field->key ?>"  type="text" class="form-control" id="<?= $field->key ?>" value="<?= $field->value ?>">
                        <span class="pmd-textfield-focused"></span>
                    </div>
                <?php elseif($field->type == "textarea"): ?>
                    <textarea rows="6" class="form-control" name="<?= $field->key ?>"><?= $field->value;?></textarea>
                <?php elseif($field->type == "image"):?>
                    <?php if(isset( $field->value ) && !empty( $field->value )): ?>
                        <?php $file_type = mb_substr($field->value, -3); ?>
                        <div class="img_settings_container">
                            <a href="" class="voyager-x"></a>
                            <img src="<?= ( $file_type == 'jpg' || $file_type == 'jpeg' || $file_type == 'png') ? $field->value : './images/file.png' ?>" style="width:200px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                        </div>
                        <div class="clearfix"></div>
                    <?php endif; ?>
                    <?php
                    echo FileInput::widget([
                        'name' => $field->key,
                        'buttonTag' => 'button',
                        'buttonName' => Yii::t('backend', 'Browse'),
                        'buttonOptions' => ['class' => 'btn btn-primary pull-right'],
                        'options' => ['class' => 'form-control'],
                        'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                      //  'thumb' => 'original',
                       // 'imageContainer' => '.img',
                        'callbackBeforeInsert' => 'function(e, data) {
                               // console.log( data );
                            }',
                    ]);
                    ?>
                 <?php elseif($field->type == "code_editor"): ?>
                    <?php $options = json_decode($field->details); ?>

                    <?php
                    echo TinyMCE::widget(
                        [
                            'name' => $field->key,
                            'value' => $field->value,
                            'clientOptions' => [
                                'language' => Yii::$app->language === 'en-EN' ? '' : mb_substr(Yii::$app->language, 0, 2),
                                'menubar' => false,
                                'height' => 300,
                                'image_dimensions' => false,
                                'plugins' => [
                                    'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                                ],
                                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                            ],
                        ]);
                    ?>
                <?php elseif($field->type == "checkbox"): ?>
                    <?php $checked = (isset($field->value) && $field->value == 'on') ? true : false;?>
                    <input type="text" name="<?= $field->key ?>" value="off" class="toggleswitch" hidden>
                    <input type="checkbox" name="<?= $field->key ?>" <?php if($checked):?> checked <?php endif;?> class="toggleswitch">
                 <?php elseif($field->type == "select_dropdown"): ?>
                    <!--Simple select -->
                    <?php $options = json_decode($field->details); ?>
                    <?php $selected_value = (isset($field->value) && !empty($field->value)) ? $field->value : NULL; ?>
                    <select class="select-simple form-control pmd-select2" name="<?= $field->key ?>">
                        <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                        <?php if(isset($options->options)): ?>
                        <?php foreach($options->options as $index => $option): ?>
                        <option value="<?= $index ?>"
                            <?php if(($default == $index && $selected_value === NULL) || $selected_value == $index): ?>
                                selected = "selected"
                            <?php endif; ?>
                        >
                        <?= $option; ?>
                        </option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                <?php elseif($field->type == "radio_btn"): ?>
                    <?php $options = json_decode($field->details); ?>
                    <?php $selected_value = (isset($field->value) && !empty($field->value)) ? $field->value : NULL; ?>
                    <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                    <ul class="radio">
                        <?php if(isset($options->options)): ?>
                        <?php foreach($options->options as $index => $option): ?>
                        <li>
                            <div class="radio">
                                <label class="pmd-radio pmd-radio-ripple-effect"  for="option-<?= $index ?>">
                                    <input type="radio"
                                           id="option-<?= $index ?>"
                                           name="<?= $field->key ?>"
                                           value="<?= $index ?>"
                                        <?php if(($default == $index && $selected_value === NULL) || $selected_value == $index):?>
                                           checked
                                    <?php endif; ?>
                                    <span class="pmd-radio-label">&nbsp;</span>
                                    <span for="click"><?= $option ?></span>
                                </label>
                            </div>

                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                <?php endif;?>
            </div>
        <?php endforeach; ?>
        <div class="panel-body">
            <p class="submit">
                <button type="submit" class="btn btn-info pull-right"><?= Yii::t( 'backend','Save Sattings') ?></button>
            </p>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<div style="clear:both"></div>

<div tabindex="-1" class="modal-danger modal fade in" id="delete-dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pmd-modal-bordered">
                <h3 class="pmd-card-title-text">
                    <i class="sort-icons voyager-sort-desc"></i>
                    <?= Yii::t("backend", "Are you sure you want to delete this?") ?>
                </h3>
            </div>
            <div class="modal-footer pmd-modal-action pmd-modal-bordered text-right">
                <?php ActiveForm::begin(["id" => "delete_form", "method" => "post"]); ?>
                <input type="submit" class="btn btn-danger pull-right delete-confirm pmd-ripple-effect btn-primary pmd-btn-flat" value="<?= Yii::t("backend", "Delete") ?>">
                <button type="button" class="btn btn-default pmd-ripple-effect pull-right pmd-btn-flat" data-dismiss="modal"><?= Yii::t("backend", "Cancel") ?></button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>



<?php
$this->registerJs('

       <!-- Delete Modal -->
        $(".delete-action").on("click", function (e) {
            var action = "' . $_c .'/__id/delete";
            id = $(e.currentTarget).data("id");
            $("#delete_form")[0].action = action.replace("__id", id);
            $("#delete_modal").modal("show");
        });
    ',
    View::POS_READY
);