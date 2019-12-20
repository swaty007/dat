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
            'background_img' => $this->string(255),
            'h1' => $this->string(255)->notNull(),
            'desc' => $this->string(1000)->notNull(),
            'html_content_top' => $this->text()->notNull(),
//            'html_content_middle' => $this->text()->notNull(),
            'html_content_bottom' => $this->text()->notNull(),
        ]);
        $this->createIndex('url', '{{%locations}}', ['url'], true);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%locations}}');
    }
}
