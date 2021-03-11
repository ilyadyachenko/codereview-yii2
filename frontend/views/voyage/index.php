<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рейсы';
?>
<div class="request-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
	        [
		        'attribute' => 'transportation_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return "Перевозка #{$model->transportation_id}";
		        }
	        ],
	        'weight',
	        [
		        'attribute' => 'date_load',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return Yii::$app->formatter->asDate($model->date_load, 'php:d.m.Y');
		        }

	        ],
	        [
		        'attribute' => 'date_unload',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return Yii::$app->formatter->asDate($model->date_unload, 'php:d.m.Y');
		        }

	        ],
        ],
	    'layout' => "{items}\n{pager}",
    ]); ?>

</div>
