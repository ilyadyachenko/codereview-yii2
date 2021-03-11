<?php
/**
 * Product: test2.
 * Date: 10/03/2021
 */

namespace backend\controllers;


use common\models\Request;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

abstract class BaseController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'view', 'create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Request models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
                               'query' => $this->getModel()::find(),
                           ]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = $this->getModel();

		if ($model->load(\Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Displays a single model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView(int $id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}


	/**
	 * Updates an existing model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate(int $id)
	{
		$model = $this->findModel($id);

		if ($model->load(\Yii::$app->Request->post()) && $model->save()) {
			return $this->redirect(['index']);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete(int $id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}


	/**
	 * Finds the model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 * @return Request the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel(int $id)
	{
		if (($model = $this->getModel()::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The Requested page does not exist.');
	}

	abstract protected function getModel();
}