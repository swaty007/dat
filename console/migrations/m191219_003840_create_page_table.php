<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m191219_003840_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'h1' => $this->string(255)->notNull(),
            'desc' => $this->string(1000)->notNull(),
            'background_img' => $this->string(255),
            'template' => $this->string(255)->notNull(),
        ]);
        $this->createIndex('url', '{{%page}}', ['url'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}
