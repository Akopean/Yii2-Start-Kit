<?php
/* @var $menuItem common\models\MenuItem */
?>

<ol class="dd-list">

<?php foreach ($menuItem as $item): ?>

    <li class="dd-item" data-id="<?= $item->id ?>">
        <div class="pull-right item_actions">
            <div class="btn-sm btn-danger pull-right delete grid-button pmd-btn-raised pmd-ripple-effect" data-id="<?= $item->id ?>">
                <i class="material-icons pmd-grid-icon">delete_sweep</i> Delete
            </div>
        </div>
        <div class="dd-handle">
            <span><?= $item->name ?></span> <small class="url"><?= $item->url ?></small>
        </div>
        <?php if(!empty($item->children)): ?>
            <?= \Yii::$app->view->renderFile('@backend/views/menu/menu-item.php', ['menuItem' => $item->children]) ?>
        <?php endif; ?>
    </li>
<?php endforeach; ?>

</ol>