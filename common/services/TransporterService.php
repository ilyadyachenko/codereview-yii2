<?php

namespace common\services;


use common\models\Transporter;
use yii\db\ActiveRecord;

/**
 * @method static getById(int $id) ?Transporter
 */
class TransporterService extends BaseService
{
	/**
	 * @return ActiveRecord|Transporter
	 */
	protected static function getEntity(): ActiveRecord
	{
		return new Transporter();
	}

}