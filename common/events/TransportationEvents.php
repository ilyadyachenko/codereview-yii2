<?php

namespace common\events;


use yii\base\Event;
use yii\web\ServerErrorHttpException;

class TransportationEvents
{
	public static function onAfterInsert(Event $event)
	{
		try{

			\Yii::$app->getMailer()->compose()
				->setFrom(\Yii::$app->params['senderEmail'])
				->setTo(\Yii::$app->params['adminEmail'])
				->setSubject('New transportation')
				->setTextBody("New transportation {$event->sender->id}")
				->send();

			return true;
		}
		catch(\Exception $ex){
			$message = $ex->getMessage();
			throw new ServerErrorHttpException($message, '500');
		}

	}
}