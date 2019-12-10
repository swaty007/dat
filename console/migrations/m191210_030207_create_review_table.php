<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m191210_030207_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'refer_link' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'h1' => $this->string(255)->notNull(),
            'h1_desc_html' => $this->text()->notNull(),
            'desc' => $this->string(500)->notNull(),
            'html_content' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review}}');
    }
}
