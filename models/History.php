<?php

namespace app\models;

use app\models\traits\ObjectNameTrait;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%history}}".
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $customer_id
 * @property int $event
 * @property string $message
 * @property string $detail
 * @property integer $user_id
 *
 * @property string $eventText
 *
 * @property Customer $customer
 * @property User $user
 *
 * @property Task $task
 * @property Event $eventTable
 * @property Sms $sms
 * @property Call $call
 */
class History extends ActiveRecord
{
    use ObjectNameTrait;

    private static $isCache = true;
    protected static $eventTexts = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%history}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ins_ts'], 'safe'],
            [['customer_id', 'user_id', 'event'], 'integer'],
            [['event'], 'required'],
            [['message', 'detail'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ins_ts' => Yii::t('app', 'Ins Ts'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'event' => Yii::t('app', 'Event'),
            'message' => Yii::t('app', 'Message'),
            'detail' => Yii::t('app', 'Detail'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getEventTable()
    {
        return $this->hasOne(Event::class, ['id' => 'event']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return array
     */
    public static function getEventTexts()
    {
        if (static::$eventTexts && static::$isCache) {
            return static::$eventTexts;
        }
        return static::$eventTexts = array_column(\app\models\Event::find()->asArray()->all(), 'name', 'id');
    }

    /**
     * @param $event
     * @return mixed
     */
    public static function getEventTextByEvent($event)
    {
        return static::getEventTexts()[$event] ?? $event;
    }

    /**
     * @return mixed|string
     */
    public function getEventText()
    {
        return static::getEventTextByEvent($this->event);
    }


    /**
     * @param $attribute
     * @return null
     */
    public function getDetailChangedAttribute($attribute)
    {
        $detail = json_decode($this->detail);
        return isset($detail->changedAttributes->{$attribute}) ? $detail->changedAttributes->{$attribute} : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailOldValue($attribute)
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return isset($detail->old) ? $detail->old : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailNewValue($attribute)
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return isset($detail->new) ? $detail->new : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailData($attribute)
    {
        $detail = json_decode($this->detail);
        return isset($detail->data->{$attribute}) ? $detail->data->{$attribute} : null;
    }
}
