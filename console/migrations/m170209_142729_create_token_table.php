<?php
use yii\db\Migration;
class m170209_142729_create_token_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'code'       => $this->string(32)->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'type'       => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('{{%token_unique}}', '{{%token}}', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('{{%fk_user_token}}', '{{%token}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }
    public function down()
    {
        $this->dropTable('{{%token}}');
    }
}