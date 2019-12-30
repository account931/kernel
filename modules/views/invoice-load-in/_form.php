<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\models\InvoiceLoadIn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-load-in-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_kontagent_id', ['inputOptions' => ['id' => 'userID']] )->textInput() ?>

    <?= $form->field($model, 'product_nomenklatura_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'unix')->textInput() ?>

    <?= $form->field($model, 'invoice_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elevator_id')->textInput() ?>

    <?= $form->field($model, 'carrier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'truck')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'truck_weight_netto')->textInput() ?>

    <?= $form->field($model, 'truck_weight_bruto')->textInput() ?>

    <?= $form->field($model, 'product_wight')->textInput() ?>

    <?= $form->field($model, 'trash_content')->textInput() ?>

    <?= $form->field($model, 'humidity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
