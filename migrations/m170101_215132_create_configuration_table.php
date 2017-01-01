<?php

use yii\db\Migration;

/**
 * Handles the creation of table `configuration`.
 */
class m170101_215132_create_configuration_table extends Migration
{
    private $tableName = '{{%configuration}}';
    private $indexName = 'idx-configuration-key';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'key' => $this->string(50)->notNull()->unique(),
            'value' => $this->text()->null(),
        ]);
        $this->createIndex(
            $this->indexName,
            $this->tableName,
            'key',
            true);
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
