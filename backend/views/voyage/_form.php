<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Voyage */
/* @var $form yii\widgets\ActiveForm */
/* @var $transportations \common\models\Transportation[] */
?>

<div class="voyage-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'transportation_id')->dropDownList(["" => 'Выберите'] + $transportations, [
		'options' => [
			$model->transportation_id => ['selected' => (!empty($model->transportation_id))],
		]
	]) ?>

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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
