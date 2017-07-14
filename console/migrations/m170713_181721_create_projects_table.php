<?php

use yii\db\Migration;

/**
 * Handles the creation of table `projects`.
 */
class m170713_181721_create_projects_table extends Migration
{
    /**
     * @inheritdoc
     */

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

         $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(80),
            'priority' => $this->integer(11),
            'end_date' => $this->datetime(),
            'status' => $this->integer(11),
            'project_id' => $this->integer(11),
        ], $tableOptions);

        $this->createIndex('tasks_project_id','tasks','project_id');

        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(55),
            'color' => $this->string(11),
        ], $tableOptions);

        $this->addForeignKey('tasks_project_id','tasks','project_id','projects','id','CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%projects}}');
        $this->dropTable('{{%tasks}}');
    }
}
