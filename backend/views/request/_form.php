<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tariff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'distance')->textInput() ?>

    <?= $form->field($model, 'address_load')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address_unload')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
