<?php
namespace frontend\controllers;

use common\services\RequestService;
use common\services\TransportationService;
use common\services\TransporterService;
use common\services\VoyageService;
use frontend\models\TransportationForm;
use frontend\models\VoyageForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Transportation controller
 */
class VoyageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post', 'get'],
                    'index' => ['get'],
                ],
            ],
        ];
    }

	/**
	 * @param int $transportationId
	 * @return string|\yii\web\Response
	 */
    public function actionCreate(int $transportationId)
    {
    	if (!$transportationModel = TransportationService::getById($transportationId))
	    {
		    return $this->render('//site/error', [
			    'message' => 'Transportation not found',
		    ]);
	    }
        $model = new VoyageForm();

    	if (Yii::$app->request->isPost)
	    {
		    $model->setTransportationId($transportationId);
		    if ($model->load(Yii::$app->request->post()) && $model->save()) {
			    return $this->redirect(['index', 'transportationId' => $transportationId]);
		    }
	    }

	    return $this->render('//voyage/create', [
		    'model' => $model,
		    'transportationModel' => $transportationModel,
	    ]);
    }

	/**
	 * @param int $transportationId
	 * @return string
	 */
    public function actionIndex(int $transportationId)
    {
	    if (!$transportationModel = TransportationService::getById($transportationId))
	    {
		    return $this->render('//site/error', [
			    'message' => 'Transportation not found',
		    ]);
	    }

	    $dataProvider = new ActiveDataProvider([
		                                           'query' => $transportationModel->getVoyages(),
	                                           ]);

	    return $this->render('//voyage/index', [
		    'dataProvider' => $dataProvider,
	    ]);
    }

}
