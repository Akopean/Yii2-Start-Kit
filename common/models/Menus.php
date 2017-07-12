<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "menus".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 */
class Menus extends ActiveRecord
{
    public $data;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'trim'],
            ['name', 'unique'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
