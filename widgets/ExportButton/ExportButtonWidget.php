<?php

namespace app\widgets\ExportButton;

use app\widgets\Export\Export;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ExportButtonWidget extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('export_button', ['linkExport' => self::getLinkExport()]);
    }

    /**
     * @return string
     */
    private static function getLinkExport(): string
    {
        $params = \Yii::$app->getRequest()->getQueryParams();
        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = 'site/export';

        return Url::to($params);
    }
}