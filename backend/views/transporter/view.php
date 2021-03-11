<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Transporter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Transporters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transporter-view">

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
            'name',
        ],
    ]) ?>

</div>
