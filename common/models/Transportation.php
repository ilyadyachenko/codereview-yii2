<?php
namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "transportation".
 *
 * @property int $id
 * @property int $request_id
 * @property int $transporter_id
 * @property float $weight
 *
 * @property Request $request
 * @property Transporter $transporter
 * @property Voyage[] $voyages
 */
class Transportation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transportation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'transporter_id', 'weight'], 'required'],
            [['request_id', 'transporter_id'], 'integer'],
            [['weight'], 'number'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
            [['transporter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transporter::className(), 'targetAttribute' => ['transporter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Заявка',
            'transporter_id' => 'Перевозчик',
            'weight' => 'Перевозимый вес',
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }

    /**
     * Gets query for [[Transporter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransporter()
    {
        return $this->hasOne(Transporter::className(), ['id' => 'transporter_id']);
    }

    /**
     * Gets query for [[Voyages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoyages()
    {
        return $this->hasMany(Voyage::className(), ['transportation_id' => 'id']);
    }

	/**
	 *
	 */
	public function asArray(): array
	{
		return ArrayHelper::toArray($this, [
			'common\models\Transportation' => [
				'transporter_id',
				'transporter' => function($model){
					return $model->getTransporter()->one()->asArray();
				},
				'weight',
			],
		]);
	}
}
