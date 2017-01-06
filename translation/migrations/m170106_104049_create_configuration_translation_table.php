<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%configuration_translation}}`.
 */
class m170106_104049_create_configuration_translation_table extends Migration
{
    private $tableName = '{{%configuration_translation}}';
    private $indexName = 'idx-configuration_translation-key-language';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'key' => $this->string(50)->notNull(),
            'language' => $this->string(16)->notNull(),
            'value' => $this->text()->notNull(),
        ]);

        $this->createIndex($this->indexName,
            $this->tableName,
            ['key', 'language'],
            true
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex($this->indexName, $this->tableName);
        $this->dropTable($this->tableName);
    }
}
