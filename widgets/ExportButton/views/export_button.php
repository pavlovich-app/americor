<?php
/**
 * @var $this \yii\web\View
 * @var $linkExport string
 */
?>

<div class="panel panel-primary panel-small m-b-0">
    <div class="panel-body panel-body-selected">
        <div class="pull-sm-right">
            <?php if (!empty($linkExport)): ?>
                <?= \yii\helpers\Html::a(Yii::t('app', 'CSV'), $linkExport, [
                    'class' => 'btn btn-success',
                    'data-pjax' => 0
                ]);
                ?>
            <?php endif; ?>
        </div>
    </div>
</div>