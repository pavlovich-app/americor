<?php

use yii\db\Migration;

/**
 * Class m230503_223946_history_event_add_foreign_key
 */
class m230503_223946_history_event_add_foreign_key extends Migration
{
    const FK_EVENT = 'fk_history_event_id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(self::FK_EVENT, 'history', 'event', 'event', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(self::FK_EVENT, 'history');
    }
}
