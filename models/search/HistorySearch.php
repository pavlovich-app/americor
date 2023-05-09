<?php

namespace app\models\search;

use app\models\History;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HistorySearch represents the model behind the search form about `app\models\History`.
 *
 * @property array $objects
 */
class HistorySearch extends History
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = History::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->addSelect('history.*');
        $query->with([
            'customer',
            'user',
            'eventTable',
            'sms',
            'task',
            'call',
            'fax',
        ]);

        return $dataProvider;
    }
}
