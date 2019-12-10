<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%locations}}`.
 */
class m191209_204546_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'url' => $this->string(255)->notNull(),
            'refer_link' => $this->string(255)->notNull(),
            'h1' => $this->string(255)->notNull(),
            'desc' => $this->string(500)->notNull(),
            'html_content_top' => $this->text()->notNull(),
            'html_content_middle' => $this->text()->notNull(),
            'html_content_bottom' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%locations}}');
    }
}
