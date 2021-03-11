<?php
namespace frontend\controllers;

use common\services\RequestService;
use frontend\models\RequestForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Request controller
 */
class RequestController extends Controller
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
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequestForm();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

	    return $this->render('//request/create', [
		    'model' => $model,
	    ]);
    }

	/**
	 * @return string
	 */
    public function actionIndex()
    {
	    $dataProvider = new ActiveDataProvider([
		                                           'query' => RequestService::getFindQuery(),
	                                           ]);

	    return $this->render('//request/index', [
		    'dataProvider' => $dataProvider,
	    ]);
    }

}
