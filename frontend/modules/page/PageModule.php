<?php

namespace frontend\modules\page;

use Yii;

/**
 * pages module definition class
 */
class PageModule extends \yii\base\Module
{
    public $static_page;
    public function __construct( $id, $parent = null, \common\components\StaticPage $static_page, array $config = [])
    {
        $this->static_page = $static_page;
        parent::__construct($id, $parent, $config);
    }

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\page\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (Yii::$app->cache->get($this->static_page->cacheId) === false)
            $this->static_page->updatePathsMap();

    }

}
