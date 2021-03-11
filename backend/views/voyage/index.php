<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рейсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voyage-index">

	<p>
		<?= Html::a('Создать рейс', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php Pjax::begin(); ?>

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
	        [
		        'attribute' => 'transportation_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        return \yii\bootstrap\Html::a("Перевозка #{$model->transportation_id}", [\yii\helpers\Url::to(['transportation/view', 'id' => $model->transportation_id])]);
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
            'phone',

	        ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
	    'layout' => "{items}\n{pager}",
    ]); ?>

	<?php Pjax::end(); ?>

</div>
