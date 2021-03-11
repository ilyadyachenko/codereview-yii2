<?php
namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $sender
 * @property string $tariff
 * @property int $distance
 * @property string|null $address_load
 * @property string|null $address_unload
 *
 * @property Transportation[] $transportations
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender', 'tariff', 'distance'], 'required'],
            [['distance'], 'integer'],
            [['address_load', 'address_unload'], 'string'],
            [['sender', 'tariff'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender' => 'Отправитель',
            'tariff' => 'Тариф',
            'distance' => 'Дистанция',
            'address_load' => 'Адрес загрузки',
            'address_unload' => 'Адрес разгрузки',
        ];
    }

    /**
     * Gets query for [[Transportations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransportations()
    {
        return $this->hasMany(Transportation::className(), ['request_id' => 'id']);
    }

	/**
	 *
	 */
	public function asArray(): array
	{
		return ArrayHelper::toArray($this, [
			'common\models\Request' => [
				'sender',
				'tariff',
				'distance',
				'address_load',
				'address_unload',
			],
		]);
	}
}
