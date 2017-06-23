<?php
namespace common\components;

use Yii;
use yii\base\Object;

/**
 * pages module definition class
 */
class StaticPage extends Object
{
    public $cacheId = 'pagesPathsMap';

    /**
     * Returns the map of ways from cache
     * Возвращает карту путей из кеша.
     * @return mixed
     */
    public function getPathsMap()
    {
        $pathsMap = Yii::$app->cache->get($this->cacheId);

        if($pathsMap !== false){
            $this->updatePathsMap();
            return Yii::$app->cache->get($this->cacheId);
        }
        return  $pathsMap;
    }


    /**
     * Saves the actual in the moment of call map of ways in cache.
     * Сохраняет в кеш актуальную на момент вызова карту путей.
     * @return void
     */
    public function updatePathsMap()
    {
        Yii::$app->cache->set($this->cacheId, $this->generatePathsMap());
    }

    /**
     * Generation of map of pages.
     * Генерация карты страниц.
     * @return array ID узла => путь до узла
     */
    public function generatePathsMap()
    {
        $nodes = Yii::$app->db->createCommand('SELECT id, slug from page;')
            ->queryAll();

        $pathsMap = array();
        $depths = array();

        foreach ($nodes as $node)
        {
            if ($node['level'] > 1)
                $path = $depths[$node['level'] - 1];
            else
                $path = '';

            $path .= $node['slug'];
            $depths[$node['level']] = $path . '/';
            $pathsMap[$node['id']] = $path;
        }

        return $pathsMap;
    }

}