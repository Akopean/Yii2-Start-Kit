<?php

/* @var $this \yii\web\View */
/* @var $content string */

?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="/js/react/react.css" rel="stylesheet" />
</head>
<body>

<div class="wrap">
    <div id="container" class="container">
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<script src="/js/react/common.js"></script>
<script src="/js/react/react.js"></script>
</body>
</html>
