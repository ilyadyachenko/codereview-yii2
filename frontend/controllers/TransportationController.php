<?php
namespace frontend\controllers;

use common\models\Request;
use common\services\RequestService;
use common\services\TransportationService;
use common\services\TransporterService;
use frontend\models\TransportationForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Transportation controller
 */
class TransportationController extends Controller
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
	 * @param int $requestId
	 * @return string|\yii\web\Response
	 */
    public function actionCreate(int $requestId)
    {
    	if (!$requestModel = RequestService::getById($requestId))
	    {
		    return $this->render('//site/error', [
			    'message' => 'Request not found',
		    ]);
	    }
        $model = new TransportationForm();

    	if (Yii::$app->request->isPost)
	    {
		    $model->setRequestId($requestId);
		    if ($model->load(Yii::$app->request->post()) && $model->save()) {
			    return $this->redirect(['index', 'requestId' => $requestId]);
		    }
	    }

	    return $this->render('//transportation/create', [
		    'model' => $model,
		    'requestModel' => $requestModel,
		    'transporters' => ArrayHelper::map(TransporterService::findAll(), 'id', 'name'),
	    ]);
    }

	/**
	 * @param int $requestId
	 * @return string
	 */
    public function actionIndex(int $requestId)
    {
    	/** @var Request $requestModel */
	    if (!$requestModel = RequestService::getById($requestId))
	    {
		    return $this->render('//site/error', [
			    'message' => 'Request not found',
		    ]);
	    }

	    $dataProvider = new ActiveDataProvider([
		                                           'query' => $requestModel->getTransportations(),
	                                           ]);

	    return $this->render('//transportation/index', [
		    'dataProvider' => $dataProvider,
		    'requestId' => $requestId
	    ]);
    }

}
