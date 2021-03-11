<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Перевозчики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporter-index">

    <p>
        <?= Html::a('Добавить перевозчика', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',

	        ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
	    'layout' => "{items}\n{pager}",
    ]); ?>

    <?php Pjax::end(); ?>

</div>
