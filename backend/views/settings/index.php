<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t( 'backend','General Settings', Yii::$app->language);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-5">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(['id' => 'settings',]); ?>
            <!-- text input -->
            <div class="form-group">
                <label for="name"><?= Yii::t( 'backend', 'Application Name');?></label>
                <input name="name" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('name')?>">
            </div>
            <!-- text input -->
            <div class="form-group">
                <label for="description"><?= Yii::t( 'backend','Short description') ?></label>
                <input name="description" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('description')?>">
            </div>
            <!-- text input -->
            <div class="form-group">
                <label for="admin_email"><?= Yii::t( 'backend','E-mail Adress') ?></label>
                <input name="admin_email" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('admin_email')?>">
            </div>
            <!-- select -->
            <div class="form-group">
                <label><?= Yii::t( 'backend','Timezone') ?></label>
                <select id="timezone_string" name="timezone_string" aria-describedby="timezone-description" title="timezone">
                    <optgroup label="Ручные смещения">
                        <?php for($i = 0; $i < 14; $i += 0.5): ?>
                            <option <?= (Yii::$app->settings->get('timezone_string') === 'UTC+'.$i) ? 'selected = "selected"' : null ?> value="UTC+<?= $i ?>">UTC+<?= $i ?></option>
                        <?php endfor; ?>
                    </optgroup>
                </select>
            </div>
            <div class="form-group">
                <fieldset><legend><span><?= Yii::t( 'backend', 'Date format') ?></span></legend>
                    <label><input type="radio" name="date_format" value="d.m.Y" <?= (Yii::$app->settings->get('date_format') === 'd.m.Y') ? 'checked="checked"' : null ?> > <span class="date-time-text">08.11.2016</span><code>d.m.Y</code></label><br>
                    <label><input type="radio" name="date_format" value="Y-m-d" <?= (Yii::$app->settings->get('date_format') === 'Y-m-d') ? 'checked="checked"' : null ?> > <span class="date-time-text">2016-11-08</span><code>Y-m-d</code></label><br>
                    <label><input type="radio" name="date_format" value="m/d/Y" <?= (Yii::$app->settings->get('date_format') === 'm/d/Y') ? 'checked="checked"' : null ?> > <span class="date-time-text">11/08/2016</span><code>m/d/Y</code></label><br>
                    <label><input type="radio" name="date_format" value="d/m/Y" <?= (Yii::$app->settings->get('date_format') === 'd/m/Y') ? 'checked="checked"' : null ?> > <span class="date-time-text">08/11/2016</span><code>d/m/Y</code></label><br>
                </fieldset>
            </div>
            <!-- text input -->
            <div class="form-group">
                <label for="posts_per_page"><?= Yii::t( 'backend', 'Maximum number of posts per page') ?></label>
                <input name="posts_per_page" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('posts_per_page')?>">
            </div>
            <p class="submit">
                <button type="submit" class="btn btn-info pull-right"><?= Yii::t( 'backend','Save') ?></button>
            </p>
            <?php ActiveForm::end(); ?>
    </div>
</div>
