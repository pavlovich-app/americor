<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\History
 */

echo $this->render('items/_item_common', [
    'user' => $model->user,
    'body' => \app\widgets\HistoryList\helpers\HistoryListHelper::getBodyByModel($model),
    'footer' => $model->sms->direction == \app\models\Sms::DIRECTION_INCOMING ?
        Yii::t('app', 'Incoming message from {number}', [
            'number' => $model->sms->phone_from ?? ''
        ]) : Yii::t('app', 'Sent message to {number}', [
            'number' => $model->sms->phone_to ?? ''
        ]),
    'iconIncome' => $model->sms->direction == \app\models\Sms::DIRECTION_INCOMING,
    'footerDatetime' => $model->ins_ts,
    'iconClass' => 'icon-sms bg-dark-blue',
]);