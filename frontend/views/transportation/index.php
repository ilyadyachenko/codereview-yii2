<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var integer $requestId */

$this->title = 'Перевозки';
?>
<div class="request-index">

	<p>
		<?= Html::a('Создать перевозку', ['create', 'requestId' => $requestId], ['class' => 'btn btn-success']) ?>
	</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
	        [
		        'attribute' => 'request_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        $item = \common\services\RequestService::getById($model->request_id);
			        $title = "#{$model->request_id} [" . ($item ? $item->sender : '-') . "]";

			        return Html::encode($title);

		        }
	        ],
	        [
		        'attribute' => 'transporter_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        $item = \common\services\TransporterService::getById($model->transporter_id);
			        $title = "#{$model->transporter_id} [" . ($item ? $item->name : '-') . "]";
			        return \yii\bootstrap\Html::a(Html::encode($title), [\yii\helpers\Url::to(['transporter/view', 'id' => $model->request_id])]);
		        }
	        ],
	        'weight',
	        [
		        'attribute' => 'voyage',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return \yii\bootstrap\Html::a("Создать рейс", [\yii\helpers\Url::to(['voyage/create', 'transportationId' => $model->id])], ['class' => 'btn btn-default']);
		        }
	        ],
	        [
		        'attribute' => 'voyage_list',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return \yii\bootstrap\Html::a("Рейсы", [\yii\helpers\Url::to(['voyage/index', 'transportationId' => $model->id])], ['class' => 'btn btn-default']);
		        }
	        ]
        ],
	    'layout' => "{items}\n{pager}",
    ]); ?>

</div>
