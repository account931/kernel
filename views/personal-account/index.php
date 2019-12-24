<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Collapse;  //  Collapse (hide/show)

$this->title = 'Personal Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="all" class="site-about animate-bottom personal-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p> Hello, <?=Yii::$app->user->identity->username;?> </p>
	<p> Your balance is 0 kg </p>

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
  
  
   <!-- Personal account menu items -->
   <div class="row"> 
       <center>
	   
	       <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-address-card-o" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Request</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>"; 
				?>
           </div>
	   
	         <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-area-chart" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Request2</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
	   
	        
			 <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-automobile" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Request3</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
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
   
   
</div> <!-- class='personal-account' -->
