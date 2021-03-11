<?php

namespace backend\controllers;

use common\services\TransportationService;
use common\services\VoyageService;
use Yii;
use common\models\Voyage;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * VoyageController implements the CRUD actions for Voyage model.
 */
class VoyageController extends BaseController
{

    /**
     * Creates a new Voyage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->getModel();

        if ($model->load(Yii::$app->request->post()))
        {
	        if (VoyageService::getLeftWeightByVoyage($model) <= 0)
	        {
	        	$model->addError('weight', 'Not available weight');
	        }

	        if (!$model->hasErrors() && $model->save())
	        {
		        return $this->redirect(['index']);
	        }

        }

        return $this->render('create', [
            'model' => $model,
	        'transportations' => ArrayHelper::map(TransportationService::findAll(), 'id', function($data) {
		        return "Перевозка #{$data['id']}";
	        }),
        ]);
    }

    /**
     * Updates an existing Voyage model.
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
	        'transportations' => ArrayHelper::map(TransportationService::findAll(), 'id', function($data) {
		        return "Перевозка #{$data['id']}";
	        }),
        ]);
    }

	protected function getModel(): Voyage
	{
		return new Voyage();
	}


}
