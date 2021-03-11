<?php

namespace backend\controllers;

use common\models\Transporter;

/**
 * TransporterController implements the CRUD actions for Transporter model.
 */
class TransporterController extends BaseController
{
	protected function getModel(): Transporter
	{
		return new Transporter();
	}
}
