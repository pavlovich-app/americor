<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\History
 */

use app\models\Customer;

$fax = $model->fax;

echo $this->render('items/_item_statuses_change', [
    'model' => $model,
    'oldValue' => \app\models\Customer::getTypeTextByType($model->getDetailOldValue('type')),
    'newValue' => Customer::getTypeTextByType($model->getDetailNewValue('type')),
]);