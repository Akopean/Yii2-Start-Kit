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

$opts = Json::htmlEncode([
    'menus' => Page::getPageSource(),
    //'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>
<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'parent_id', ['id' => 'parent_id']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->textInput(['maxlength' => true,  'type' => 'number', 'value' => $model->level === null ? 0 : $model->level]) ?>

    <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

    <?= $model->isNewRecord ? '' : $form->field($model, 'slug')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'content')->widget(TinyMCE::className(), [
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
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList([
        Page::STATUS_ACTIVE => 'Open',
        Page::STATUS_INACTIVE => 'Close',
        ],
        ['options' =>
            [
               Page::STATUS_ACTIVE => ['selected' => true]
            ]
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
