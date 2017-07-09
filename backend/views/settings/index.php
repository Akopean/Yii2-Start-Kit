<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

\backend\assets\PropellerSelect2Asset::register($this);

$this->title = Yii::t( 'backend','Settings', Yii::$app->language);
$this->params['breadcrumbs'][] = $this->title;
echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);
?>
<div class="row">
    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= \Yii::$app->view->renderFile('@backend/views/layouts/alerts.php') ?>
        <div class="alert alert-info">
            <strong><?= Yii::t( 'backend', 'How To Use:') ?></strong>
            <p><?= Yii::t( 'backend', 'You can get the value of each setting anywhere on your site by calling')?> <code>Yii::$app->settings->get('key')</code></p>
        </div>

        <?php $form = ActiveForm::begin(['id' => 'settings', 'method'  => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="panel">
            <?php foreach(Yii::$app->settings->getAll() as $setting): ?>
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <code>Yii::$app->settings->get('<?= $setting->key?>')</code>
                    </h3>
                    <div class="panel-actions">
                        <a href="<?= Yii::$app->urlManager->createUrl('settings/move-down/'. $setting->id)?>">
                            <i class="material-icons md-dark pmd-sm">keyboard_arrow_down</i>
                            <i class="sort-icons voyager-sort-asc"></i>
                        </a>
                        <a href="<?= Yii::$app->urlManager->createUrl('settings/move-up/'. $setting->id)?>">
                            <i class="material-icons md-dark pmd-sm">keyboard_arrow_up</i>
                            <i class="sort-icons voyager-sort-desc"></i>
                        </a>
                        <a href="<?= Yii::$app->urlManager->createUrl('settings/delete/'. $setting->id)?>">
                            <i class="material-icons md-dark pmd-sm">delete</i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <?php if($setting->type == "text"):?>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="Default" class="control-label"><?= $setting->name ?></label>
                            <input name="<?= $setting->key ?>"  type="text" class="form-control" id="<?= $setting->key ?>" value="<?= $setting->value ?>">
                            <span class="pmd-textfield-focused"></span>
                        </div>
                    <?php elseif($setting->type == "text_area"):?>
                        <textarea rows="8" class="form-control" name="<?= $setting->key ?>"><?= $setting->value;?></textarea>
                    <?php elseif($setting->type == "checkbox"): ?>
                        <?php $checked = (isset($setting->value) && $setting->value == 'on') ? true : false;?>
                        <input type="text" name="<?= $setting->key ?>" value="off" class="toggleswitch" hidden>
                        <input type="checkbox" name="<?= $setting->key ?>" <?php if($checked):?> checked <?php endif;?> class="toggleswitch">
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

        <?= $this->render('_form', ['model' => new \common\models\Settings()]) ?>

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