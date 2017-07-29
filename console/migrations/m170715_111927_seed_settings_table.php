<?php

use yii\db\Migration;

class m170715_111927_seed_settings_table extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%settings}}', [
            'id' => 1,
            'name' => 'Site Title',
            'key' => 'site_title',
            'value' => 'Site Title',
            'type' => 'text',
            'order' => 1,
        ]);

        $this->insert('{{%settings}}', [
            'id' => 2,
            'name' => 'Site Description',
            'key' => 'site_description',
            'value' => 'Site Description',
            'type' => 'text',
            'order' => 2,
        ]);


        $this->insert('{{%settings}}', [
            'id' => 3,
            'name' => 'Site Logo',
            'key' => 'site_logo',
            'value' => '',
            'type' => 'image',
            'order' => 3,
        ]);


        $this->insert('{{%settings}}', [
            'id' => 4,
            'name' => 'Google Analytics Client ID',
            'key' => 'google_analytics_client_id',
            'value' => '',
            'type' => 'text',
            'order' => 4,
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%settings}}', ['id' => 1]);
        $this->delete('{{%settings}}', ['id' => 2]);
        $this->delete('{{%settings}}', ['id' => 3]);
        $this->delete('{{%settings}}', ['id' => 4]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170715_111927_seed_settings_table cannot be reverted.\n";

        return false;
    }
    */
}
