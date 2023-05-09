<?php

use app\models\search\HistorySearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider ActiveDataProvider */
?>

<?php Pjax::begin(['id' => 'grid-pjax', 'formSelector' => false]); ?>

<?= \app\widgets\ExportButton\ExportButtonWidget::widget() ?>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'options' => [
        'tag' => 'ul',
        'class' => 'list-group'
    ],
    'itemOptions' => [
        'tag' => 'li',
        'class' => 'list-group-item'
    ],
    'emptyTextOptions' => ['class' => 'empty p-20'],
    'layout' => '{items}{pager}',
]); ?>

<?php Pjax::end(); ?>
