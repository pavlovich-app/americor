<?php

use yii\db\Migration;
use app\models\Event;

/**
 * Class m230503_215929_migrate_data_to_events_table
 */
class m230503_215929_migrate_data_to_events_table extends Migration
{
    const T_EVENT = 'event';

    const EVENT_CREATED_TASK = 1;
    const EVENT_UPDATED_TASK = 2;
    const EVENT_COMPLETED_TASK = 3;

    const EVENT_INCOMING_SMS = 4;
    const EVENT_OUTGOING_SMS = 5;

    const EVENT_INCOMING_CALL = 6;
    const EVENT_OUTGOING_CALL = 7;

    const EVENT_INCOMING_FAX = 8;
    const EVENT_OUTGOING_FAX = 9;

    const EVENT_CUSTOMER_CHANGE_TYPE = 10;
    const EVENT_CUSTOMER_CHANGE_QUALITY = 11;


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert(self::T_EVENT, ['id', 'event_group', 'name'], [
            [self::EVENT_CREATED_TASK, Event::EVENT_GROUP_TASK, 'Task created'],
            [self::EVENT_UPDATED_TASK, Event::EVENT_GROUP_TASK, 'Task updated'],
            [self::EVENT_COMPLETED_TASK, Event::EVENT_GROUP_TASK, 'Task completed'],

            [self::EVENT_INCOMING_SMS, Event::EVENT_GROUP_SMS, 'Incoming message'],
            [self::EVENT_OUTGOING_SMS, Event::EVENT_GROUP_SMS, 'Outgoing message'],

            [self::EVENT_INCOMING_CALL, Event::EVENT_GROUP_CALL, 'Type changed'],
            [self::EVENT_OUTGOING_CALL, Event::EVENT_GROUP_CALL, 'Property changed'],

            [self::EVENT_INCOMING_FAX, Event::EVENT_GROUP_FAX, 'Outgoing call'],
            [self::EVENT_OUTGOING_FAX, Event::EVENT_GROUP_FAX, 'Incoming call'],

            [self::EVENT_CUSTOMER_CHANGE_TYPE, Event::EVENT_GROUP_CUSTOMER_CHANGE_TYPE, 'Incoming fax'],
            [self::EVENT_CUSTOMER_CHANGE_QUALITY, Event::EVENT_GROUP_CUSTOMER_CHANGE_QUALITY, 'Outgoing fax'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable(self::T_EVENT);
    }
}
