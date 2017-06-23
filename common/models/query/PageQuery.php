<?php

namespace common\models\query;

use common\models\Page;
use yii\db\ActiveQuery;

class PageQuery extends ActiveQuery
{
    public function active()
    {
     return $this->andWhere(['status' => Page::STATUS_ACTIVE]);
    }
    /**
     * @param null $db
     * @return array|Page[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
    /**
     * @param null $db
     * @return array|null|Page
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}