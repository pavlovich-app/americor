<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\search\HistorySearch
 */
use app\models\Event;

switch ($model->eventTable->event_group) {
    case Event::EVENT_GROUP_TASK:
    {
        echo $this->render('rows/task_row', ['model' => $model]);
        break;
    }
    case Event::EVENT_GROUP_SMS:
    {
        echo $this->render('rows/sms_row', ['model' => $model]);
        break;
    }
    case Event::EVENT_GROUP_FAX:
    {
        echo $this->render('rows/fax_row', ['model' => $model]);
        break;
    }
    case Event::EVENT_GROUP_CUSTOMER_CHANGE_TYPE:
    {
        echo $this->render('rows/consumer_change_type_row', ['model' => $model]);
        break;
    }
    case Event::EVENT_GROUP_CUSTOMER_CHANGE_QUALITY:
    {
        echo $this->render('rows/consumer_change_quality_row', ['model' => $model]);
        break;
    }
    case Event::EVENT_GROUP_CALL:
    {
        echo $this->render('rows/call_row', ['model' => $model]);
        break;
    }
    default:
    {
        $this->render('rows/defaultl_row', ['model' => $model]);
    }
}