<?php

namespace common\models\query;

use paulzi\adjacencyList\AdjacencyListQueryTrait;

/**
 * This is the ActiveQuery class for [[\common\models\AdjacencyList]].
 *
 * @see \common\models\AdjacencyList
 */
class MenuItemQuery extends \yii\db\ActiveQuery
{
    use AdjacencyListQueryTrait;
}