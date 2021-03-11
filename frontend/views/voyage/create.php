<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VoyageForm */
/* @var $transportationModel common\models\Transportation */
/* @var $form ActiveForm */
?>
<div class="site-request">

    <?php $form = ActiveForm::begin(); ?>
	Перевозка #<?=Html::encode($transportationModel->id)?><br/>
	<?= $form->field($model, 'date_load')->widget(\kartik\date\DatePicker::classname(), [
		                                                                                  'options' => [
			                                                                                  'value' => !$model->date_load?'':Yii::$app->formatter->asDate($model->date_load, 'php:d.m.Y')
		                                                                                  ],
		                                                                                  'type' => \kartik\date\DatePicker::TYPE_INPUT,
		                                                                                  'pluginOptions' => [
			                                                                                  'autoclose' => true,
			                                                                                  'format' => 'dd.mm.yyyy'
		                                                                                  ]]
	) ?>

	<?= $form->field($model, 'date_unload')->widget(\kartik\date\DatePicker::classname(), [
		                                                                                    'options' => [
			                                                                                    'value' => !$model->date_unload?'':Yii::$app->formatter->asDate($model->date_unload, 'php:d.m.Y')
		                                                                                    ],
		                                                                                    'type' => \kartik\date\DatePicker::TYPE_INPUT,
		                                                                                    'pluginOptions' => [
			                                                                                    'autoclose' => true,
			                                                                                    'format' => 'dd.mm.yyyy'
		                                                                                    ]]
	) ?>

	<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'weight')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-request -->
