<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "transporter".
 *
 * @property int $id
 * @property string $name
 *
 * @property Transportation[] $transportations
 */
class Transporter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transporter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Перевозчик',
        ];
    }

    /**
     * Gets query for [[Transportations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransportations()
    {
        return $this->hasMany(Transportation::className(), ['transporter_id' => 'id']);
    }

    /**
     *
     */
    public function asArray(): array
    {
    	return ArrayHelper::toArray($this, [
		    'common\models\Transporter' => [
			    'id',
			    'name'
		    ],
	    ]);
    }
}
