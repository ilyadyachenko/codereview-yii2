<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Voyage */
/* @var $transportations \common\models\Transportation[] */


$this->title = 'Изменить рейс: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Рейсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="voyage-update">

    <?= $this->render('_form', [
        'model' => $model,
	    'transportations' => $transportations
    ]) ?>

</div>
