<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Общие настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-5">
        <?php $form = ActiveForm::begin(['id' => 'settings',]); ?>
            <!-- text input -->
            <div class="form-group">
                <label for="name">Название Сайта</label>
                <input name="name" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('name')?>">
            </div>
            <!-- text input -->
            <div class="form-group">
                <label for="description">Краткое описание</label>
                <input name="description" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('description')?>">
            </div>
            <!-- text input -->
            <div class="form-group">
                <label for="admin_email">Адрес e-mail</label>
                <input name="admin_email" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('admin_email')?>">
            </div>
            <!-- select -->
            <div class="form-group">
                <label>Часовой пояс</label> &nbsp;&nbsp;&nbsp;
                <select id="timezone_string" name="timezone_string" aria-describedby="timezone-description" title="timezone">
                    <optgroup label="Ручные смещения">
                        <? for($i = 0; $i < 14; $i += 0.5): ?>
                            <option <?= (Yii::$app->settings->get('timezone_string') === 'UTC+'.$i) ? 'selected = "selected"' : null ?> value="UTC+<?= $i ?>">UTC+<?= $i ?></option>
                        <? endfor; ?>
                    </optgroup>
                </select>
            </div>
            <div class="form-group">
                <fieldset><legend><span>Формат даты</span></legend>
                    <label><input type="radio" name="date_format" value="d.m.Y" <?= (Yii::$app->settings->get('date_format') === 'd.m.Y') ? 'checked="checked"' : null ?> > <span class="date-time-text">08.11.2016</span><code>d.m.Y</code></label><br>
                    <label><input type="radio" name="date_format" value="Y-m-d" <?= (Yii::$app->settings->get('date_format') === 'Y-m-d') ? 'checked="checked"' : null ?> > <span class="date-time-text">2016-11-08</span><code>Y-m-d</code></label><br>
                    <label><input type="radio" name="date_format" value="m/d/Y" <?= (Yii::$app->settings->get('date_format') === 'm/d/Y') ? 'checked="checked"' : null ?> > <span class="date-time-text">11/08/2016</span><code>m/d/Y</code></label><br>
                    <label><input type="radio" name="date_format" value="d/m/Y" <?= (Yii::$app->settings->get('date_format') === 'd/m/Y') ? 'checked="checked"' : null ?> > <span class="date-time-text">08/11/2016</span><code>d/m/Y</code></label><br>
                </fieldset>
            </div>
            <div class="form-group">
                <span>Язык сайта</span>
                <select id="lang" name="lang"  class="form-control" title="Язык сайта">
                    <optgroup label="Установленные">
                        <option value="en_EN" lang="en" <?= (Yii::$app->settings->get('lang') === 'en_EN') ? 'selected="selected"' : null ?>>English (United States)</option>
                        <option value="ru_RU" lang="ru" <?= (Yii::$app->settings->get('lang') === 'ru_RU') ? 'selected="selected"' : null ?>>Русский</option>
                    </optgroup>
                </select>
            </div>
            <!-- text input -->
            <div class="form-group">
                <label for="posts_per_page">Максимальное кол-во постов на странице</label>
                <input name="posts_per_page" type="text" class="form-control" placeholder="Enter ..." value="<?= Yii::$app->settings->get('posts_per_page')?>">
            </div>
            <p class="submit">
                <button type="submit" class="btn btn-info pull-right">Сохранить</button>
            </p>
            <?php ActiveForm::end(); ?>
    </div>
</div>
