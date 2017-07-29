<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `options`.
 */
class m150112_135165_create_settings_table extends Migration
{
    public function up()
    {

         $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%settings}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'key' =>  Schema::TYPE_STRING . '(255) NOT NULL',
            'value' => Schema::TYPE_TEXT . ' NULL',
            'details' => Schema::TYPE_TEXT . ' NULL',
            'type' => Schema::TYPE_STRING . '(255) NOT NULL',
            'order' => Schema::TYPE_SMALLINT. ' DEFAULT 1',
        ], $tableOptions);

        $this->createIndex('idx_settings_name', '{{%settings}}', 'name', true);
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}
