<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Request */

$this->title = 'Изменить заявку: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="request-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
