
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Registration requests';
$this->params['breadcrumbs'][] = $this->title;
?>



<div id="all" class="admin-default-index animate-bottom">
    <h1><?= Html::encode($this->title) ?></h1>
	
   <!------ FLASH Message to show if the account not yet activated by the admin ----->
   <?php if( Yii::$app->session->hasFlash('approveOK') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('approveOK'); ?>
    </div>
    <?php endif;?>
   <!------ END FLASH  ----->
   
	
	<?php
	//display users to approve
	if(!$requests){
		echo "No new users to approve.";
	} else {
      foreach ($requests as $b){
		echo '<div class="row list-group-item">';
		    echo '<div class="col-sm-2 col-xs-2">' .
		          $b->username.
		    '</div>';
		
		    echo '<div class="col-sm-2 col-xs-4">'.
		         $b->email.
		    '</div>';
			 
			//button Confirm 
	        echo '<div class="col-sm-2 col-xs-3">';
		         $form = ActiveForm::begin(); ?>
                 <?= $form->field($model, 'yourInput')->hiddenInput(['value'=> $b->id])->label(false) ?>
				 <?= $form->field($model, 'yourInputEmail')->hiddenInput(['value'=> $b->email])->label(false) ?>
				 <div class="form-group">
                 <?= Html::submitButton(Yii::t('app', 'Confirm'), ['class' => 'btn btn-small btn-info fixx']) ?>
                 </div>
                 <?php ActiveForm::end(); 
	        echo '</div>';
			
			//button to view User
	        echo '<div class="col-sm-2 col-xs-2">'.
                 Html::submitButton(Yii::t('app', 'View'), ['class' => 'btn btn-danger']) .
	            '</div>';
		
		echo '</div>';
	  }
	}
	?>

</div>
