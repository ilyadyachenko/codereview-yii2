<?php

namespace backend\controllers;

use common\models\Request;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends BaseController
{
	protected function getModel(): Request
	{
		return new Request();
	}
}
