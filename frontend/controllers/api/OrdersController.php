<?php
namespace frontend\controllers\api;

use common\models\Request;
use common\models\Transportation;
use common\services\ChainService;
use common\services\OrderService;
use common\services\RequestService;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Api controller
 */
class OrdersController extends Controller
{
	public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		\Yii::$app->response->format = Response::FORMAT_JSON;

		return parent::beforeAction($action);
	}

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'shipping' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actionIndex($version): ?array
    {
    	$requestItems = RequestService::findAll();
    	if (empty($requestItems))
	    {
	    	return [];
	    }

	    $result = [];
    	/** @var Request $requestItem */
	    foreach ($requestItems as $requestItem)
	    {
		    $result[] = ChainService::getByRequest($requestItem);
	    }

	    return $result;
    }

	/**
	 * @param integer $version
	 * @param integer $orderId
	 * @return array|bool[]
	 * @throws \yii\db\Exception
	 */
    public function actionShipping(int $version, int $orderId): array
    {
    	$request = RequestService::getById($orderId);
    	if (empty($request))
	    {
		    return $this->outputErrors(['Order not found']);
	    }

    	$fields = \Yii::$app->request->post();

	    $transaction = \Yii::$app->db->beginTransaction();

	    /** @var Transportation|array $transportation */
	    $transportation = OrderService::createTransportation($orderId, $fields);

	    if (is_array($transportation) && !empty($transportation['error']))
	    {
		    $transaction->rollBack();
		    return $this->outputErrors($transportation);
	    }

	    if (!empty($fields['voyages']))
	    {
	    	$response = OrderService::createVoyages($transportation, $fields['voyages']);
		    if (is_array($response) && !empty($response['error']))
		    {
			    $transaction->rollBack();
			    return $this->outputErrors($response);
		    }
	    }

	    $transaction->commit();

	    return ['success' => true];
    }

	/**
	 * @param $values
	 * @return array
	 */
    private function outputErrors($values): array
    {
    	return ArrayHelper::merge(['error' => true], $values);
    }


}
