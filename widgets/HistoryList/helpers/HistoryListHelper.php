<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Call;
use app\models\Customer;
use app\models\History;
use app\models\Event;

class HistoryListHelper
{
    public static function getBodyByModel(History $model)
    {
        switch ($model->eventTable->event_group) {
            case Event::EVENT_GROUP_TASK : {
                $task = $model->task;
                return "$model->eventText: " . ($task->title ?? '');
            }
            case Event::EVENT_GROUP_SMS: {
                return $model->sms->message ?? '';
            }
            case Event::EVENT_GROUP_CUSTOMER_CHANGE_TYPE: {
                return "$model->eventText " .
                    (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
            }
            case Event::EVENT_GROUP_CUSTOMER_CHANGE_QUALITY: {
                return "$model->eventText " .
                    (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
            }
            case Event::EVENT_GROUP_CALL: {
                /** @var Call $call */
                $call = $model->call;
                return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
            }
            default: {
                return $model->eventText;
            }
        }
    }
}