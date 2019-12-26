
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Collapse;  //  Collapse (hide/show)

$this->title = 'Admin Panel';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="admin-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
	<p> Hello, <?=Yii::$app->user->identity->username;?> </p>
	<?php 
	    if(Yii::$app->user->can('adminX')){ echo "<b>You have admin rights.</b>";}
	 ?>
	
	
   <!-- Admin Image --> 
  
	    <div class="col-sm-12 col-xs-12">
			<?php
			 $image = '<i class="fa fa-address-card-o" style="font-size:56px"></i>';	
		    // echo "<div class='subfolder border'>" .
			        Html::a( $image ."<p>Sign in</p><br>" , ["/site/login"], $options = ["title" => "Sign in",]) . 
				    "</div>";
			 ?>
	    </div>
   
  
   
   
   <!------ FLASH Message to show if the account not yet activated by the admin ----->
   <?php if( Yii::$app->session->hasFlash('failX') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('failX'); ?>
    </div>
    <?php endif;?>
   <!------ END FLASH  ----->
   

	
	<!-- Image -->
	<center>
	<div class="row">
	   <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-address-card-o" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Admin access</p><br>" , ["#"] , $options = ["title" => "more  info",]) . 
		            "</div><br>"; 
				?>
       </div>
	 </div>
	 </center>
	 <!-- Image -->
		   

    
	
	
	
	
	 <?php
  //Collapse widget
   echo Collapse::widget([
    'items' => [
        [
            'label' => 'Profile',
            'content' => '   
                        <div class="col-lg-offset-1" style="color:#999;">
                         <b>Here goes personal info</b>.
						 <p>Name: '. Yii::$app->user->identity->username . '</p>
						 <p>Email: '. Yii::$app->user->identity->email . '</p>
                       </div>',
            // to  be  this  block open  by  default   de  comment  the  following 
            /*'contentOptions' => [
                'class' => 'in'
            ]*/  
          ], 
	  ]
  ]);
  // End Collapse widget
  ?>
  
  
   <!-- Admin account menu items -->
   <div class="row"> 
       <center>
	   
	       <div class="col-sm-2 col-xs-6 badge1 " data-badge="6"> <!-- badge -->
                <?php		
                $image = '<i class="fa fa-address-card-o" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Register requests</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>"; 
				?>
           </div>
	   
	         <div class="col-sm-2 col-xs-6 badge1 " data-badge="2">
                <?php		
                $image = '<i class="fa fa-area-chart" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX lavender'>" .
			        Html::a( $image ."<p>Load up requests</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
	   
	        
			 <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-automobile" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>View all users</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
			
			<div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-balance-scale" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Request4</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
			
   </div><!-- class='row' -->
   <!-- End Personal account menu items -->
   
   
   
   
    

</div>
