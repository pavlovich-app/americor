<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\History
 */

use app\models\Call;

/** @var Call $call */
$call = $model->call;
$answered = $call && $call->status == Call::STATUS_ANSWERED;

echo $this->render('items/_item_common', [
    'user' => $model->user,
    'content' => $call->comment ?? '',
    'body' => \app\widgets\HistoryList\helpers\HistoryListHelper::getBodyByModel($model),
    'footerDatetime' => $model->ins_ts,
    'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
    'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
    'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
]);