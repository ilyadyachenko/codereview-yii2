<?php

namespace common\services;


use common\models\Transportation;
use common\models\Transporter;
use common\models\Voyage;
use yii\db\ActiveRecord;

/**
 * @method static getById(int $id) ?Transportation
 */
class TransportationService extends BaseService
{
	/**
	 * @param Transportation $transportation
	 * @return array|ActiveRecord[]|Voyage[]
	 */
	public static function findVoyages(Transportation $transportation): array
	{
		return $transportation->getVoyages()->all();
	}

	/**
	 * @return ActiveRecord|Transportation
	 */
	protected static function getEntity(): ActiveRecord
	{
		return new Transportation();
	}

}