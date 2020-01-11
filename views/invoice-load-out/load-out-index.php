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
	
	
	
	<!------ FLASH Message ----->
   <?php if( Yii::$app->session->hasFlash('statusOK') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('statusOK'); ?>
    </div>
    <?php endif;?>
   <!------ END FLASH  --------->
   
   
   
   	<!--- Image -->
	 <div class="row"> 
       <center>
	   <div class="col-sm-2 col-xs-6"> 
        <?php		
        $image = '<i class="fa fa-balance-scale" style="font-size:56px"></i>';	
        echo "<div class='subfolder border shadowX'>" .
		     Html::a( $image ."<p></p><br>" , ["#"], $options = ["title" => "Sign up requests",]) . 
		     "</div>"; 
	    ?>
       </div>
	   </center>
	</div></br>
   
  
	
	
		
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
        <?= $form->field($model, 'product_wieght')->textInput(['placeholder' => 'вага в кг']) ?>
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
