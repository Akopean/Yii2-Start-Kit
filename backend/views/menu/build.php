<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */
/* @var $menuItem common\models\MenuItem */

\backend\assets\PropellerSelect2Asset::register($this);
\backend\assets\NestableAsset::register($this);
\backend\assets\ToastrAsset::register($this);

$this->title = Yii::t('backend', 'Build {modelClass}: ', [
        'modelClass' => 'Menu',
    ]) . $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);

?>


<h1 class="page-title">
    <i class="voyager-list"></i>Menu Builder (<?= $model->name?>)
</h1>

<?= \Yii::$app->view->renderFile('@backend/views/layouts/alerts.php') ?>

<div class="alert alert-info">
    <strong><?= Yii::t( 'backend', 'How To Use:') ?></strong>
    <p><?= Yii::t( 'backend', 'You can output this menu anywhere on your site by calling ')?> <code>Yii::$app->settings->get('key')</code></p>
</div>


    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="dd">
                            <?= \Yii::$app->view->renderFile('@backend/views/menu/menu-item.php',['menuItem' => $menuItem]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"><?= Yii::t('backend', 'Delete this Menu item?') ?></h3>
                </div>
                <div class="modal-footer">
                    <?php $form = ActiveForm::begin(['id' => 'delete_form', 'method' => 'post']); ?>
                    <input type="submit" class="btn btn-danger pull-right delete-confirm"
                           value="<?= Yii::t('backend', 'Delete') ?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><?= Yii::t('backend', 'Cancel') ?></button>
                    <?php ActiveForm::end(); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?= $this->render('_build-form', ['model' => new \common\models\MenuItem()]) ?>

<?php
$this->registerJs("
        $('.dd').nestable({/* config options */});
        /**
         * Delete menu item
         */
        $('.item_actions').on('click', '.delete', function (e) {
            var action = '/menu/" . $model->id . "/item/__id/delete';
            id = $(e.currentTarget).data('id');
            $('#delete_form')[0].action = action.replace('__id', id);
            $('#delete_modal').modal('show');
        });

        /**
         * Reorder items
         */
        $('.dd').on('change', function (e) {
            var action = '/menu/" . $model->id . "/order';
            $.post( action, {
                order: JSON.stringify($('.dd').nestable('serialize')),
                _token: '" . Yii::$app->request->csrfToken . "'
            }, function (data) {
                toastr.success('" . Yii::t('backend', 'Success fully updated menu order.') . "');
            });
        });
    ",
    View::POS_READY
);