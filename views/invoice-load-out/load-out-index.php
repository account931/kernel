<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Balance;

$this->title = 'Замовити вiдвантаження';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	<p class="text-danger">Add Model validation is weight is no more than in DB + if weight to take == weight in DB {delete from Balance} </p>

	<div class="col-sm-8 col-xs-12">
      <p>
	     <i class="fa fa-balance-scale" style="font-size:96px; color:navy;"></i>
      </p>
    </div>
	
		<div class="col-sm-12 col-xs-12"></div>
	
	
	<?php $form = ActiveForm::begin( 
	    [ 'options' => ['class' => 'form-inline'],
		'fieldConfig' => [
                //'enableError' => true ,
                'template' => '<div class="col-sm-12">{label}</div>
				              <div class="col-sm-6">{input}{error}</div>'
                                ]
		]); ?>
	
    <div class="col-sm-4 col-xs-12">
	<?= $form->field($model, 'user_id')->textInput(['value' => Yii::$app->user->identity->id, 'placeholder' => 'User ID']); ?>
	</div>
	
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'invoice_unique_id')->textInput([ 'placeholder' => 'Invoice ID']) ?> <!-- hiddenInput(['value'=> '', 'id' => 'some_id'])->label(false); -->
    </div>
	
	<div class="col-sm-4 col-xs-12">
    <?=$form->field($model, 'product_id')->dropDownList(ArrayHelper::map(Balance::find()->where(['balance_user_id' => Yii::$app->user->identity->id])->joinWith(['productname'])->all(),'balance_productName_id', 'productname.pr_name_name'),['prompt'=>'choose product']);?>
    </div>
	
	<div class="col-sm-4 col-xs-12">
    <?= $form->field($model, 'product_wieght')->textInput(['placeholder' => 'weight in kg to load out']) ?>
    </div>
	
	<div class="col-sm-4 col-xs-12">
	<?= $form->field($model, 'user_date_unix')->textInput(['placeholder' => 'Unix']); ?>
	</div>
	
	
	</div>
	

	
	
	<div class="col-sm-12 col-xs-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
       </div>
	 </div>

    <?php ActiveForm::end(); ?>
	
	
	
	
	
	
	
	
	
	
    
</div>
