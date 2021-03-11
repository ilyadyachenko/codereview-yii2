<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Transportation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Перевозки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transportation-view">

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
		        'attribute' => 'request_id',
		        'format' => 'raw',
		        'value' => function($model)
		        {
			        $item = \common\services\RequestService::getById($model->request_id);
			        $title = "#{$model->request_id} [" . ($item ? $item->sender : '-') . "]";

			        return \yii\bootstrap\Html::a(Html::encode($title), [\yii\helpers\Url::to(['request/view', 'id' => $model->request_id])]);

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
        ],
    ]) ?>

</div>
