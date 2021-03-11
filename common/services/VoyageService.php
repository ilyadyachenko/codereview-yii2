<?php

namespace common\services;


use common\models\Transportation;
use common\models\Voyage;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @method static getById(int $id) ?Voyage
 */
class VoyageService extends BaseService
{

	public static function getLeftWeightByVoyage(Voyage $voyage)
	{

		/** @var Transportation|null $transportation */
		$transportation = $voyage->getTransportation()->one();
		if (!isset($transportation))
		{
			return null;
		}

		$voyages = TransportationService::findVoyages($transportation);
		if (empty($voyages))
		{
			return $transportation->weight;
		}

		$weights = ArrayHelper::getColumn($voyages, function (Voyage $element) {
			return $element->weight;
		});

		$sumWeight = array_sum($weights);

		return $transportation->weight - $sumWeight;
	}

	/**
	 * @return ActiveRecord|Voyage
	 */
	protected static function getEntity(): ActiveRecord
	{
		return new Voyage();
	}

}