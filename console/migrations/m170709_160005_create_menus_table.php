<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menus`.
 */
class m170709_160005_create_menus_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menus', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menus');
    }
}
