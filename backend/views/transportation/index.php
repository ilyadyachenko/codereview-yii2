<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\Transportation */

$this->title = 'Перевозки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transportation-index">

    <p>
        <?= Html::a('Создать перевозку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
	        [
		        'attribute' => 'request_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        $item = $model->getRequest()->one();
			        $title = "#{$model->request_id} [" . ($item ? $item->sender : '-') . "]";

			        return \yii\bootstrap\Html::a(Html::encode($title), [\yii\helpers\Url::to(['request/view', 'id' => $model->request_id])]);

		        }
	        ],
	        [
		        'attribute' => 'transporter_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
		        	$item = $model->getTransporter()->one();
			        $title = "#{$model->transporter_id} [" . ($item ? $item->name : '-') . "]";
			        return \yii\bootstrap\Html::a(Html::encode($title), [\yii\helpers\Url::to(['transporter/view', 'id' => $model->request_id])]);
		        }
	        ],
            'weight',

	        ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
	    'layout' => "{items}\n{pager}",
    ]); ?>

    <?php Pjax::end(); ?>

</div>
