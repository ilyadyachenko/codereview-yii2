<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Voyage */
/* @var $transportations \common\models\Transportation[] */

$this->title = 'Create Voyage';
$this->params['breadcrumbs'][] = ['label' => 'Voyages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voyage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
	    'transportations' => $transportations
    ]) ?>

</div>
