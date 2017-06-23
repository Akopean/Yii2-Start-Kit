<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 * @property string $token
 * @property integer $type
 * @property integer $created_at
 *
 * @property User $user
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $expire
     */
    public function generateToken($expire)
    {
        $this->created_at = $expire;
        $this->token = \Yii::$app->security->generateRandomString();
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if ($insert) {
            static::deleteAll(['user_id' => $this->user_id, 'type' => $this->type]);
            $this->setAttribute('created_at', date(DATE_RFC3339));
            $this->setAttribute('code', Yii::$app->security->generateRandomString());
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'token' => 'token',
            'created_at' => function () {
                return date(DATE_RFC3339, $this->created_at);
            },
        ];
    }
}
