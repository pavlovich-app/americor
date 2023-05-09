<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m230503_214646_create_event_table extends Migration
{
    const T_EVENT = '{{%event}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::T_EVENT, [
            'id' => $this->primaryKey(),
            'event_group' => $this->smallInteger(6)->unsigned(),
            'name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::T_EVENT);
    }
}
