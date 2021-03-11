<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Request */
/* @var $form ActiveForm */
?>
<div class="site-request">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'sender') ?>
        <?= $form->field($model, 'tariff') ?>
        <?= $form->field($model, 'distance') ?>
        <?= $form->field($model, 'address_load')->textarea() ?>
        <?= $form->field($model, 'address_unload')->textarea() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-request -->
