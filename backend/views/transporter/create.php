<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\transporter */

$this->title = 'Create Transporter';
$this->params['breadcrumbs'][] = ['label' => 'Transporters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transporter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
