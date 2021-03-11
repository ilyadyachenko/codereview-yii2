<?php

namespace common\services;


use common\models\Transportation;
use frontend\models\TransportationForm;
use frontend\models\VoyageForm;
use yii\helpers\ArrayHelper;

class OrderService
{
	/**
	 * @param integer t$requestId
	 * @param array $postFields
	 * @return array|Transportation
	 */
	public static function createTransportation(int $requestId, array $postFields)
	{
		$transportationForm = new TransportationForm();

		$transportationForm->setAttributes(ArrayHelper::merge($postFields, ['request_id' => $requestId]));
		if (!$transportationForm->save())
		{
			return ArrayHelper::merge(['error' => true], $transportationForm->getErrors());;
		}

		return $transportationForm->getTransportation();
	}

	/**
	 * @param Transportation $transportation
	 * @param array $voyageFields
	 * @return array|bool
	 */
	public static function createVoyages(Transportation $transportation, array $voyageFields)
	{
		$voyageForm = new VoyageForm();
		foreach ($voyageFields as $voyagerItemFields)
		{
			$voyageForm->setAttributes(ArrayHelper::merge($voyagerItemFields, ['transportation_id' => $transportation->id]));
			if (!$voyageForm->save())
			{
				return ArrayHelper::merge(['error' => true], $voyageForm->getErrors());;
			}
		}

		return true;
	}
}