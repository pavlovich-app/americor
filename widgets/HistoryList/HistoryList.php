<?php

namespace app\widgets\HistoryList;

use app\models\search\HistorySearch;
use yii\base\Widget;
use Yii;

class HistoryList extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $model = new HistorySearch();

        return $this->render('main', [
            'dataProvider' => $model->search(Yii::$app->request->queryParams)
        ]);
    }
}
