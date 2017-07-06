<?php

use yii\helpers\Html;
/* @var $lang \frontend\widgets\Lang */
?>

<li class="menu_lang">
    <a class="btn btn-link" data-toggle="dropdown">
        <?= ucfirst($current);?> ▼
    </a>
    <ul class="dropdown-menu">
        <?php foreach ($lang as $key => $l): ?>
            <?php if($l !== $current): ?>
            <li class="item-lang">
                <?= Html::a($l, '/') ?>
            </li>
        <?php endif; ?>
        <?php endforeach;?>
    </ul>
</li>
