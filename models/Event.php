<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $event_group
 * @property string $name
 */
class Event extends ActiveRecord
{
    const EVENT_GROUP_TASK = 1;
    const EVENT_GROUP_SMS = 2;
    const EVENT_GROUP_FAX = 3;
    const EVENT_GROUP_CUSTOMER_CHANGE_TYPE = 4;
    const EVENT_GROUP_CUSTOMER_CHANGE_QUALITY = 5;
    const EVENT_GROUP_CALL = 6;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'event_group'], 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_group' => Yii::t('app', 'Event Group'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
