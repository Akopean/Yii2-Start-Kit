<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\widgets\LanguageDropdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('frontend','My Company'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => Yii::t('frontend','Home'), 'url' => Yii::$app->urlManager->createUrl('/')],
        ['label' => Yii::t('frontend','About'), 'url' => Yii::$app->urlManager->createUrl('/about')],
        ['label' => Yii::t('frontend','Contact'), 'url' => Yii::$app->urlManager->createUrl('/contact')],
        ['label' => Yii::t('frontend','Admin'), 'url' => 'http://yii2-start-kit-admin'],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('frontend', 'Signup'), 'url' => Yii::$app->urlManager->createUrl('/signup')];
        $menuItems[] = ['label' =>  Yii::t('frontend','Login'), 'url' => Yii::$app->urlManager->createUrl('/login')];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                Yii::t('frontend','Logout ({username})', ['username' => Yii::$app->user->identity->username ]),
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
/*
     //Language Menu Item
        $menuItems[] = '<li class="menu_lang"><a class="btn btn-link" data-toggle="dropdown">'
        . ucfirst(mb_substr(Yii::$app->language, 0 , 2)) . ' ▼ </a>'
        . LanguageDropdown::widget()
        . '</li>';
*/
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
