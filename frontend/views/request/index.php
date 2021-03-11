<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
?>
<div class="request-index">

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'sender',
            'tariff',
            'distance',
            'address_load:ntext',
	        [
		        'attribute' => 'transportation_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return \yii\bootstrap\Html::a("Создать перевозку", [\yii\helpers\Url::to(['transportation/create', 'requestId' => $model->id])], ['class' => 'btn btn-default']);
		        }
	        ],
	        [
		        'attribute' => 'transportation_list',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return \yii\bootstrap\Html::a("Перевозки", [\yii\helpers\Url::to(['transportation/index', 'requestId' => $model->id])], ['class' => 'btn btn-default']);
		        }
	        ]
        ],
	    'layout' => "{items}\n{pager}",
    ]); ?>

</div>
