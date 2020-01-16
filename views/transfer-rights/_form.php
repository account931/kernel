<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Balance;

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
	
 
	
	<div class="col-sm-6 col-xs-12"><i class="fa fa-magic" style="font-size:24px"></i>
    <?= $form->field($model, 'from_user_id')->textInput(['id' => 'userID', 'value'=>  Yii::$app->user->identity->id, 'placeholder' => 'User ID']) ?> <!-- hiddenInput(['value'=> '', 'id' => 'some_id'])->label(false); -->
    </div>
	
	<div class="col-sm-6 col-xs-12"> <i class="fa fa-male" style="font-size:24px"></i>
	<?= $form->field($model, 'user2')->textInput(['id' => 'userName', 'placeholder' => 'Вкажіть email на кого переоформлюєте']); //not involved in form saving, just to get value (Id of user) from autocmplete and set it to {user_kontagent_id} ?>
	</div>
	
	<div class="col-sm-6 col-xs-12"><i class="fa fa-newspaper-o" style="font-size:24px"></i>
    <?= $form->field($model, 'to_user_id')->textInput(['id' => 'userIDToTransfer', 'value'=> 'will be hidden field', 'placeholder' => 'User ID to']) ?> <!-- hiddenInput(['value'=> '', 'id' => 'some_id'])->label(false); -->
    </div>
	
	
	<div class="col-sm-6 col-xs-12"><i class="fa fa-key" style="font-size:24px"></i>
	<?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Balance::find()->where(['balance_user_id' => Yii::$app->user->identity->id])->joinWith(['productname'])->all(),'balance_productName_id', 'productname.pr_name_name'),['prompt'=>'choose product']);?>
    </div>
	
	 <div class="col-sm-6 col-xs-12"><i class="fa fa-laptop" style="font-size:24px"></i>
     <?= $form->field($model, 'product_weight')->textInput(['placeholder' => 'вага в кг']) ?>
     </div>
	
	 <div class="col-sm-6 col-xs-12"><i class="fa fa-keyboard-o" style="font-size:24px"></i>
	 <?= $form->field($model, 'unix_time')->textInput(['value' => time(), 'placeholder' => 'Unix']); ?>
	 </div>
	

	<!--
	<div class="col-sm-12 col-xs-12">
    <?= $form->field($model, 'date')->textInput() ?>
    </div>
	-->
	
	<div class="col-sm-6 col-xs-12"><i class="fa fa-map-signs" style="font-size:24px"></i>
    <?= $form->field($model, 'invoice_id')->textInput(['value' => "Trans-" .Yii::$app->security->generateRandomString(3). "-" . time()]); //invoiceID to for]) ?>
    </div>
	
	
	
	<div class="col-sm-12 col-xs-12">
        <div class="form-group">
            <?= Html::submitButton('Виконати', ['class' => 'btn btn-success']) ?>
       </div>
	</div>

    <?php ActiveForm::end(); ?>

</div>