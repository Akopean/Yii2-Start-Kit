<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `menu_item`.
 */
class m170709_160339_create_menu_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%menu_item}}', [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer()->null(),
            'parent_id' => $this->integer()->unsigned()->null(),
            'name' => $this->string(255)->notNull(),
            'url' =>  $this->string(255)->notNull(),
            'route' =>  $this->string(255)->Null(),
            'target' =>  $this->string(255)->notNull(),
            'icon_class' =>  $this->string(255)->Null(),
            'order' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('menu_item_menus_id','menu_item','menu_id','menus','id','CASCADE', 'RESTRICT');

        $this->createIndex('idx_menu_item_order', '{{%menu_item}}', 'order');
        $this->createIndex('idx_menu_item_parent_id', '{{%menu_item}}', 'parent_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%menu_item}}');
    }
}
