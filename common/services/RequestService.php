<?php

namespace common\services;


use common\models\Request;
use common\models\Transportation;
use yii\db\ActiveRecord;

/**
 * @method static getById(int $id): ?Request
 */
class RequestService extends BaseService
{

	/**
	 * @param Request $request
	 * @return array|ActiveRecord[]|Transportation[]
	 */
	public static function findTransportations(Request $request): array
	{
		return $request->getTransportations()->all();
	}

	/**
	 * @return ActiveRecord|Request
	 */
	protected static function getEntity(): ActiveRecord
	{
		return new Request();
	}

}