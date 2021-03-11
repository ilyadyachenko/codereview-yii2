<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'sender',
            'tariff',
            'distance',
            'address_load:ntext',
            //'address_unload:ntext',

	        ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
	    'layout' => "{items}\n{pager}",
    ]); ?>

    <?php Pjax::end(); ?>

</div>
