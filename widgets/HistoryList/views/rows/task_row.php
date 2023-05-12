<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\History
 */

$task = $model->task;

echo $this->render('items/_item_common', [
    'user' => $model->user,
    'body' => \app\widgets\HistoryList\helpers\HistoryListHelper::getBodyByModel($model),
    'iconClass' => 'fa-check-square bg-yellow',
    'footerDatetime' => $model->ins_ts,
    'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : '',
]);