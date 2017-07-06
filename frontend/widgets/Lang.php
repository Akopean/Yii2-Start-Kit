<?php

namespace frontend\widgets;

use common\components\Languages;
use yii\bootstrap\Widget;
use Yii;

class Lang extends Widget
{
    public function run() {
        return $this->render('lang/view', [
            'current' => mb_substr(Yii::$app->language, 0, 2),
            'lang' => Yii::$app->urlManager->languages,
        ]);
    }
}