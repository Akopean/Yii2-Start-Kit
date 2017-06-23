<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m170612_123313_create_page_table extends Migration
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

        $this->createTable(
            '{{%page}}',
            [
                'id' => $this->primaryKey(),
                'level' => $this->integer()->unsigned()->notNull(),
                'author_id' => $this->integer()->notNull(),
                'parent_id' => $this->integer()->unsigned()->notNull(),

                'status' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0),

                'slug' => $this->string(120)->notNull(),
                'layout' => $this->string(15)->defaultValue(null),
                'title' => $this->string(255)->notNull(),
                'content' => $this->text()->notNull(),

                'meta_title' => $this->string(255)->null(),
                'meta_description' => $this->string(255)->null(),
                'meta_keywords' => $this->string(255)->null(),

                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);


        $this->addForeignKey('page_user_id','page','author_id','user','id');

        $this->createIndex('idx-page-slug', 'page', 'slug');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('page');
    }
}
