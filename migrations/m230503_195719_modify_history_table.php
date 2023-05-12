<?php

use yii\db\Migration;

/**
 * Class m230503_195719_modify_history_table
 */
class m230503_195719_modify_history_table extends Migration
{
    const T_HISTORY = 'history';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(self::T_HISTORY, 'object');
        $this->dropColumn(self::T_HISTORY, 'object_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn(self::T_HISTORY, 'object', $this->integer()->after('event'));
        $this->addColumn(self::T_HISTORY, 'object_id', $this->integer()->after('object'));
    }
}
