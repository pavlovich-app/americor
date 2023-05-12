<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\History
 */

use app\models\Customer;

$fax = $model->fax;

echo $this->render('items/_item_statuses_change', [
    'model' => $model,
    'oldValue' => Customer::getQualityTextByQuality($model->getDetailOldValue('quality')),
    'newValue' => Customer::getQualityTextByQuality($model->getDetailNewValue('quality')),
]);