<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transportation */
/* @var $requestModel common\models\Request */
/* @var $form ActiveForm */
?>
<div class="site-request">

    <?php $form = ActiveForm::begin(); ?>
	Заявка #<?=Html::encode($requestModel->id)?><br/>
	<?= $form->field($model, 'transporter_id')->dropDownList(["" => 'Выберите'] + $transporters, [
		'options' => [
			$model->transporter_id => ['selected' => (!empty($model->transporter_id))],
		]
	]) ?>
	<?= $form->field($model, 'weight') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-request -->
