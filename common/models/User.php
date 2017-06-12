<?php
namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * User model
 *
 * @property string adminPermission
 *
 */
class User extends \mdm\admin\models\User
{
     const ROLE_ADMIN = 'administrator';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return parent::rules();
    }

    /**
     * @param $username
     * @return bool
     */
    public static function isAdmin($username)
    {
        if (Yii::$app->user->can(self::ROLE_ADMIN)){
            return true;
        } else {
            Yii::$app->user->logout();
            Yii::$app->getResponse()->redirect(Url::to(['login']));
        }
    }
}
