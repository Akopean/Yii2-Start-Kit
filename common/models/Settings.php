<?php

namespace common\models;


/**
 * This is the model class for table "options".
 *
 * @property integer $id
 * @property string $option_name
 * @property string $default_value
 * @property string $option_value
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
            [['value', 'default_value'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'default_value' => 'Default Value',
            'value' => 'Value',
        ];
    }
}
