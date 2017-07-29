<?php

namespace common\models;

use common\models\query\MenuItemQuery;
use paulzi\adjacencyList\AdjacencyListBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "menu_item".
 *
 * @property int $id
 * @property int $menu_id
 * @property int $parent_id
 * @property string $name
 * @property string $url
 * @property string $route
 * @property string $target
 * @property string $icon_class
 * @property int $order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Menus $menu
 */
class MenuItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['menu_id', 'parent_id', 'order', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url', 'route', 'target', 'icon_class'], 'string', 'max' => 255],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::className(), 'targetAttribute' => ['menu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => array(
                    ActiveRecord::EVENT_BEFORE_INSERT => array('created_at', 'updated_at'),
                    ActiveRecord::EVENT_BEFORE_UPDATE => array('updated_at'),
                ),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu_id' => Yii::t('app', 'Menu ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'route' => Yii::t('app', 'Route'),
            'target' => Yii::t('app', 'Target'),
            'icon_class' => Yii::t('app', 'Icon Class'),
            'order' => Yii::t('app', 'Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::className(), ['id' => 'menu_id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getChildren()
    {
        return MenuItem::find()->where(['parent_id' => $this->id])->all();
    }
}
