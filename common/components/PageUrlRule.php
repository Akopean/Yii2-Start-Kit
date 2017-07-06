<?php

namespace common\components;

use common\models\Page;
use Yii;
use yii\web\UrlRuleInterface;
use yii\base\Object;


/**
 * Class PageUrlRule
 * @package common\components
 *  @var StaticPage $static_page
 */
class PageUrlRule extends Object implements UrlRuleInterface
{
    public $static_page;

    public function createUrl($manager, $route, $params)
    {
      /*  $pathsMap = $this->static_page->getPathsMap();

        if ($route === 'pages/default/view' && isset($params['id'], $pathsMap[$params['id']]))
            return $pathsMap[$params['id']];
        else
            return false;*/
        return false;
    }

    /**
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        $this->static_page = Yii::$app->get('static_page');
        $pathInfo = trim($request->pathInfo, '/');

        if (preg_match('#^([\w-]+)#i', $pathInfo, $matches)) {
            $pathsMap = $this->static_page->getPathsMap();

            if (is_array($pathsMap) && (bool)array_search($pathInfo, $pathsMap) === true) {
                return ['page/default/view', ['slug' => $pathInfo]];
            }
        }
        return false;
    }
}