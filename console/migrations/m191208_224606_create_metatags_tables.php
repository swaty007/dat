<?php

use yii\db\Migration;

/**
 * Class m191208_224606_create_metatags_tables
 */
class m191208_224606_create_metatags_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%meta_tags}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'keywords' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'time_update' => $this->integer()->notNull()->defaultValue(0),
        ]);
        $this->createIndex('object', '{{%meta_tags}}', ['model', 'model_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meta_tags}}');
    }
}
