<?php

namespace common\models;

use pendalf89\filemanager\behaviors\MediafileBehavior;
use Yii;
/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $name
 * @property string $key
 * @property string $value
 * @property string $type
 * @property int $order
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key', 'type'], 'required'],
            [['value', 'details'], 'string'],
            [['order'], 'integer'],
            ['value', 'safe'],
            [['name', 'key', 'type'], 'string', 'max' => 255],
            [['name', 'key'], 'unique'],
        ];
    }



    public function behaviors()
    {
        return [
            'mediafile' => [
                'class' => MediafileBehavior::className(),
                'name' => 'key',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'key' => Yii::t('app', 'Key'),
            'details' => Yii::t('app', 'Options'),
            'value' => Yii::t('app', 'Value'),
            'type' => Yii::t('app', 'Type'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * @return bool
     */
    public function store(){
        $lastSetting = Settings::find()->orderBy(['order' => SORT_DESC])->one();

        if (is_null($lastSetting)) {
            $this->order = 0;
        } else {
            $this->order = intval($lastSetting->order) + 1;
        }

        return $this->save();
    }
}