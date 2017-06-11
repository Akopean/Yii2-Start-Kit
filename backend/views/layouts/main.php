<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
backend\assets\PropellerAsset::register($this);
\backend\assets\AppAsset::register($this);
$breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?php $this->beginBody() ?>
    <body>
    <!-- Header Starts -->
    <?= $this->render('header'); ?>
    <!-- Header Ends -->

    <?= $this->render('sidebar'); ?>



    <!--content area start-->
    <div id="content" class="pmd-content content-area dashboard">

        <div class="container-fluid">
            <?= $content ?>
        </div>

    </div><!--end content area-->

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>