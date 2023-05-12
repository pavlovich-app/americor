<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\History
 */

echo $this->render('items/_item_common', [
    'user' => $model->user,
    'body' => \app\widgets\HistoryList\helpers\HistoryListHelper::getBodyByModel($model),
    'bodyDatetime' => $model->ins_ts,
    'iconClass' => 'fa-gear bg-purple-light',
]);