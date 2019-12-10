<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%model_meta}}`.
 */
class m191210_025843_create_model_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%model_meta}}', [
            'id' => $this->primaryKey(),
            'model' => $this->string(255)->notNull(),
            'model_id' => $this->integer(11)->notNull(),
            'meta_key' => $this->string(255)->notNull(),
            'meta_title' => $this->string(255)->notNull(),
            'meta_value' => $this->text()->notNull(),
        ]);

        $this->createIndex('meta_key', '{{%model_meta}}', 'meta_key');
        $this->createIndex('model_id', '{{%model_meta}}', 'model_id');
        $this->createIndex('model', '{{%model_meta}}', 'model');

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%model_meta}}');
    }
}
