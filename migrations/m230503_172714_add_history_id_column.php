<?php

use yii\db\Migration;

/**
 * Class m230503_172714_add_history_id_column
 */
class m230503_172714_add_history_id_column extends Migration
{
    const C_HISTORY = 'history_id';
    const TABLES = ['sms', 'fax', 'call', 'task'];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach (self::TABLES as $table) {
            $this->addColumn($table, self::C_HISTORY, $this->integer()->unique()->after('id'));
            $this->addForeignKey("fk_{$table}_to_history_id", $table, self::C_HISTORY, 'history', 'id');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach (self::TABLES as $table) {
            $this->dropForeignKey("fk_{$table}_to_history_id", $table);
            $this->dropColumn($table, self::C_HISTORY);
        }
    }
}
