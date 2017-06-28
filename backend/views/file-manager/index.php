<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\TinyMCE;
use pendalf89\filemanager\widgets\FileInput;

?>
<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->widget(FileInput::className(), [
    'buttonTag' => 'button',
    'buttonName' => 'Browse',
    'buttonOptions' => ['class' => 'btn btn-default'],
    'options' => ['class' => 'form-control'],
    // Widget template
    'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
    // Optional, if set, only this image can be selected by user
    'thumb' => 'original',
    // Optional, if set, in container will be inserted selected image
    'imageContainer' => '.img',
    // Default to FileInput::DATA_URL. This data will be inserted in input field
    'pasteData' => FileInput::DATA_URL,
    // JavaScript function, which will be called before insert file data to input.
    // Argument data contains file data.
    // data example: [alt: "Ведьма с кошкой", description: "123", url: "/uploads/2014/12/vedma-100x100.jpeg", id: "45"]
    'callbackBeforeInsert' => 'function(e, data) {
    console.log( data );
    }',
    ]);
    ?>
    <br />
    <?= $form->field($model, 'content')->widget(TinyMCE::className(), [
        'clientOptions' => [
            'language' => 'ru',
            'menubar' => false,
            'height' => 500,
            'image_dimensions' => false,
            'plugins' => [
                'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
            ],
            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>








