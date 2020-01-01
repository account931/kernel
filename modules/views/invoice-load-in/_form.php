<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\models\InvoiceLoadIn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-load-in-form">

    <?php $form = ActiveForm::begin( 
	    [ 'options' => ['class' => 'form-inline'],
		'fieldConfig' => [
                //'enableError' => true ,
                'template' => '<div class="col-sm-12">{label}</div>
				              <div class="col-sm-6">{input}{error}</div>'
                                ]
		]); ?>
	
    <div class="col-sm-4 col-xs-12">
	<?= $form->field($model, 'user_name')->textInput(['id' => 'userName', 'placeholder' => 'Email']); //not involved in form saving, just to get value (Id of user) from autocmplete and set it to {user_kontagent_id} ?>
	</div>
	
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'user_kontagent_id')->textInput(['id' => 'userID', 'value'=> 'will be hidden field', 'placeholder' => 'User ID']) ?> <!-- hiddenInput(['value'=> '', 'id' => 'some_id'])->label(false); -->
    </div>
	
	<div class="col-sm-4 col-xs-12">
	<?= $form->field($model, 'product_nomenklatura_id')->dropDownList(ArrayHelper::map($products, 'pr_name_id', 'pr_name_name'), ['prompt' => 'Select product']); ?>
    <?php //echo $form->field($model, 'product_nomenklatura_id')->textInput(); ?>
    </div>
	
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'date')->textInput() ?>
    </div>
	
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'unix')->textInput() ?>
    </div>
	
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'invoice_id')->textInput(['maxlength' => true]) ?>
    </div>
	
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'elevator_id')->textInput(['value'=> 5]) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'carrier')->textInput(['value'=> 'Carrier1', 'maxlength' => true]) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'driver')->textInput(['value'=> 'Nikolay', 'maxlength' => true]) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'truck')->textInput(['value'=> 'Volvo', 'maxlength' => true]) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'truck_weight_netto')->textInput(['value'=> 3000, 'placeholder' => 'Truck weight Netto']) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'truck_weight_bruto')->textInput(['value'=> 4000, 'placeholder' => 'Truck weight Brutto']) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'product_wight')->textInput(['value'=> 250, 'placeholder' => 'Product weight']) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'trash_content')->textInput(['value'=> 23, 'placeholder' => 'Trash content %']) ?>
    </div>
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'humidity')->textInput(['value'=> 13, 'placeholder' => 'Humidity %']) ?>
    </div>
	
	<div class="col-sm-12 col-xs-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
       </div>
	 </div>

    <?php ActiveForm::end(); ?>

</div>
