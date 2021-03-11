<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transportation */
/* @var $form yii\widgets\ActiveForm */
/* @var $requests \common\models\Request[] */
/* @var $transporters \common\models\Transporter[] */
?>

<div class="transportation-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'request_id')->dropDownList(["" => 'Выберите'] + $requests, [
		'options' => [
			$model->request_id => ['selected' => (!empty($model->request_id))],
		]
	]) ?>

	<?= $form->field($model, 'transporter_id')->dropDownList(["" => 'Выберите'] + $transporters, [
		'options' => [
			$model->transporter_id => ['selected' => (!empty($model->transporter_id))],
		]
	]) ?>


    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
