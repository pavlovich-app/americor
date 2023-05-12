<?php

use yii\db\Migration;

/**
 * Class m230503_213042_history_event_column_to_integer
 */
class m230503_213042_history_event_column_to_integer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("alter table history modify event int not null;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("alter table history modify event varchar(255) not null;");
    }
}
