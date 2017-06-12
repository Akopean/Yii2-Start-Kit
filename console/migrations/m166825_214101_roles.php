<?php

use yii\db\Migration;

class m166825_214101_roles extends Migration
{
    public function up()
    {
        $auth = \Yii::$app->get('authManager');
        $auth->removeAll();

        $permission = $auth->createPermission('/*');
        $permission->description = 'All Permission';
        $auth->add($permission);

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('administrator');
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $permission);


        $auth->assign($admin, 1);
        $auth->assign($user, 2);
    }

    public function down()
    {
        $auth = \Yii::$app->get('authManager');
        $auth->remove($auth->getRole('administrator'));
        $auth->remove($auth->getRole('user'));
    }
}
