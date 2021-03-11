<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Transportation */
/* @var $requests \common\models\Request[] */
/* @var $transporters \common\models\Transporter[] */


$this->title = 'Изменить перевозку: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Перевозки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="transportation-update">

    <?= $this->render('_form', [
        'model' => $model,
	    'requests' => $requests,
	    'transporters' => $transporters,
    ]) ?>

</div>
