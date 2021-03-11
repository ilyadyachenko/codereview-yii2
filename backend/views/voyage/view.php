<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Voyage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Voyages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="voyage-view">

	<p>
		<?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Вы действительно хотите удалить данный элемент?',
				'method' => 'post',
			],
		]) ?>
	</p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
	        [
		        'attribute' => 'transportation_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return \yii\bootstrap\Html::a("#{$model->transportation_id}", [\yii\helpers\Url::to(['transportation/view', 'id' => $model->transportation_id])]);
		        }
	        ],
	        [
		        'attribute' => 'weight',
		        'format' => 'raw',
		        'label' => 'Вес',
		        'value' => function($model)
		        {
			        $item = \common\services\TransportationService::getById($model->transportation_id);
			        return $item ? $item->weight : '-';
		        }
	        ],
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
            'phone',
        ],
    ]) ?>

</div>
