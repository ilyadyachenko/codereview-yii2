<?php

namespace common\services;


use common\models\Request;
use common\models\Transportation;
use common\models\Voyage;
use yii\helpers\ArrayHelper;

class ChainService
{
	/**
	 * @param Request $request
	 * @return array|null
	 */
	public static function getByRequest(Request $request): ?array
	{

		$result = $request->asArray();

		$result['transportations'] = [];
		$transportationItems = RequestService::findTransportations($request);
		if (empty($transportationItems))
		{
			$result['transportations'] = null;
			return $result;
		}

		foreach ($transportationItems as $transportationItem)
		{
			$result['transportations'][] = static::getByTransportation($transportationItem);
		}

		return $result;
	}

	/**
	 * @param Transportation $transportation
	 * @return array
	 */
	public static function getByTransportation(Transportation $transportation)
	{
		$result = $transportation->asArray();
		$result['voyages'] = [];
		$voyageItems = TransportationService::findVoyages($transportation);
		if (empty($voyageItems))
		{
			$result['voyages'] = null;
			return $result;
		}


		$result['voyages'] = ArrayHelper::getColumn($voyageItems, function (Voyage $element) {
			return $element->asArray();
		});

		return $result;
	}
}