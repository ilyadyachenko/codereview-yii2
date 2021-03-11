<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "voyage".
 *
 * @property int $id
 * @property int $transportation_id
 * @property float $weight
 * @property string|null $date_load
 * @property string|null $date_unload
 * @property string $phone
 *
 * @property Transportation $transportation
 */
class Voyage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voyage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transportation_id', 'phone'], 'required'],
            [['transportation_id'], 'integer'],
	        [['weight'], 'number'],
            [['date_load', 'date_unload'], 'safe'],
            [['phone'], 'string', 'max' => 15],
            [['transportation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transportation::className(), 'targetAttribute' => ['transportation_id' => 'id']],

	        [['date_load'], 'validateDates'],
        ];
    }

	public function validateDates()
	{

		if(strtotime($this->date_load) > strtotime($this->date_unload))
		{
			$this->addError('date_load','Please give correct Date load and unload dates');
			$this->addError('date_unload','Please give correct Date load and unload dates');
		}
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transportation_id' => 'Перевозка',
	        'weight' => 'Перевозимый вес',
            'date_load' => 'Дата загрузки',
            'date_unload' => 'Дата выгрузки',
            'phone' => 'Телефон водителя',
        ];
    }

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['date_load'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['date_load'],
				],
				"value" => function() {
					return Yii::$app->formatter->asDate($this->date_load, "php:Y-m-d 00:00:00");
				}
			],
			[
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['date_unload'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['date_unload'],
				],
				"value" => function() {
					return Yii::$app->formatter->asDate($this->date_unload, "php:Y-m-d 00:00:00");
				}
			],
		];
	}

    /**
     * Gets query for [[Transportation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransportation()
    {
        return $this->hasOne(Transportation::className(), ['id' => 'transportation_id']);
    }

	/**
	 *
	 */
	public function asArray(): array
	{
		return ArrayHelper::toArray($this, [
			'common\models\Voyage' => [
				'id',
				'date_load' => function ($model) {
					return \Yii::$app->formatter->asDate($model->date_load, 'php:d.m.Y');
				},
				'date_unload' => function ($model) {
					return \Yii::$app->formatter->asDate($model->date_unload, 'php:d.m.Y');
				},
				'phone',
				'weight'
			],
		]);
	}
}
