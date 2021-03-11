<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Transportation */
/* @var $requests \common\models\Request[] */
/* @var $transporters \common\models\Transporter[] */

$this->title = 'Create Transportation';
$this->params['breadcrumbs'][] = ['label' => 'Transportations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transportation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
	    'requests' => $requests,
	    'transporters' => $transporters,
    ]) ?>

</div>
