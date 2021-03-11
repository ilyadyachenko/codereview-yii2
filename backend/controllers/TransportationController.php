<?php

namespace backend\controllers;

use common\models\Transportation;
use common\services\RequestService;
use common\services\TransporterService;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * TransportationController implements the CRUD actions for Transportation model.
 */
class TransportationController extends BaseController
{

    /**
     * Creates a new Transportation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->getModel();

	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		    return $this->redirect(['index']);
	    }
        return $this->render('create', [
            'model' => $model,
	        'requests' => ArrayHelper::map(RequestService::findAll(), 'id', 'sender'),
	        'transporters' => ArrayHelper::map(TransporterService::findAll(), 'id', 'name'),
        ]);
    }

    /**
     * Updates an existing Transportation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
	        'requests' => ArrayHelper::map(RequestService::findAll(), 'id', 'sender'),
	        'transporters' => ArrayHelper::map(TransporterService::findAll(), 'id', 'name'),
        ]);
    }

	protected function getModel(): Transportation
	{
		return new Transportation();
	}
}
