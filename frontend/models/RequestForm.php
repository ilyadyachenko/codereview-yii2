<?php
namespace frontend\models;

use common\models\Request;
use yii\base\Model;


/**
 * Request form
 */
class RequestForm extends Model
{
    public $sender;
    public $tariff;
    public $distance;
    public $address_load;
    public $address_unload;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
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
	 * @return bool
	 */
	public function save()
	{
		if (!$this->validate())
		{
			return null;
		}

		$request = new Request();
		$request->setAttributes([
			'sender' => $this->sender,
			'tariff' => $this->tariff,
			'distance' => $this->distance,
			'address_load' => $this->address_load,
			'address_unload' => $this->address_unload,
		]);

		return $request->save();

	}

}
