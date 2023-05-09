<?php

use yii\db\Migration;
use app\models\History;

/**
 * Class m230503_204419_history_replace_statuses_to_integer
 */
class m230503_204419_history_replace_statuses_to_integer extends Migration
{
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


    const EVENT_CREATED_TASK_TEXT = [self::EVENT_CREATED_TASK => 'created_task'];
    const EVENT_UPDATED_TASK_TEXT = [self::EVENT_UPDATED_TASK => 'updated_task'];
    const EVENT_COMPLETED_TASK_TEXT = [self::EVENT_COMPLETED_TASK => 'completed_task'];

    const EVENT_INCOMING_SMS_TEXT = [self::EVENT_INCOMING_SMS => 'incoming_sms'];
    const EVENT_OUTGOING_SMS_TEXT = [self::EVENT_OUTGOING_SMS => 'outgoing_sms'];

    const EVENT_INCOMING_CALL_TEXT = [self::EVENT_INCOMING_CALL => 'incoming_call'];
    const EVENT_OUTGOING_CALL_TEXT = [self::EVENT_OUTGOING_CALL => 'outgoing_call'];

    const EVENT_INCOMING_FAX_TEXT = [self::EVENT_INCOMING_FAX => 'incoming_fax'];
    const EVENT_OUTGOING_FAX_TEXT = [self::EVENT_OUTGOING_FAX => 'outgoing_fax'];

    const EVENT_CUSTOMER_CHANGE_TYPE_TEXT = [self::EVENT_CUSTOMER_CHANGE_TYPE => 'customer_change_type'];
    const EVENT_CUSTOMER_CHANGE_QUALITY_TEXT = [self::EVENT_CUSTOMER_CHANGE_QUALITY => 'customer_change_quality'];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = self::renderSQL();
        return self::executeSQL($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = self::renderSQL(false);
        return self::executeSQL($sql);
    }

    /**
     * @param bool $isUp
     * @return string
     */
    public static function renderSQL(bool $isUp = true): string
    {
        $sql = null;

        foreach (self::getEvents() as $eventKey => $eventText) {
            $value = $isUp ? $eventKey : $eventText;
            $condition = $isUp ? $eventText : $eventKey;
            $sql .= "UPDATE `history` SET event = '{$value}' WHERE event = '{$condition}';";
        }
        return $sql;
    }

    /**
     * @param string $sql
     * @return int
     * @throws \yii\db\Exception
     */
    public static function executeSQL(string $sql): int
    {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * @return array
     */
    public static function getEvents(): array
    {
        return
            self::EVENT_CREATED_TASK_TEXT +
            self::EVENT_UPDATED_TASK_TEXT +
            self::EVENT_COMPLETED_TASK_TEXT +
            self::EVENT_INCOMING_SMS_TEXT +
            self::EVENT_OUTGOING_SMS_TEXT +
            self::EVENT_INCOMING_CALL_TEXT +
            self::EVENT_OUTGOING_CALL_TEXT +
            self::EVENT_INCOMING_FAX_TEXT +
            self::EVENT_OUTGOING_FAX_TEXT +
            self::EVENT_CUSTOMER_CHANGE_TYPE_TEXT +
            self::EVENT_CUSTOMER_CHANGE_QUALITY_TEXT;
    }
}
