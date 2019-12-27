<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Collapse;  //  Collapse (hide/show)

$this->title = 'Personal Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="all" class="site-about animate-bottom personal-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><i class="fa fa-drivers-license-o" style="font-size:14px"></i> Welcome, <?=Yii::$app->user->identity->username;?> </p>
	<p> Your balance is : 
	    <?php
		    //display user's balance
		    if(!$balance){
			    echo " <b>0</b> <i>(you seem to have nothing on your balance so far).</i>";
				
		    } else {
		        
		        foreach ($balance as $k){
					echo "<div class='row'>";
				    echo "<div class='col-sm-1 col-xs-4'><i class='fa fa-shopping-basket' style='font-size:16px'></i> " . 
					                                            $k->productname->pr_name_name . ":</div>" . //hasOne relation
						 "<div class='col-sm-1 col-xs-2'><b>" . $k->balance_amount_kg . "</b>" .        //weight
						                                        $k->productname->pr_name_measure  . "</div>";  //hasOne relation
				    echo "</div>";
			    }
				
			}
		?>
	</p>

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
			        Html::a( $image ."<p>Вiдвантажити</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>"; 
				?>
           </div>
	   
	         <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-area-chart" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX lavender'>" .
			        Html::a( $image ."<p>View my transport</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
	   
	        
			 <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-automobile" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>View history</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
			
			<div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-balance-scale" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Bot помiчник</p><br>" , ["", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
			
   </div><!-- class='row' -->
   <!-- End Personal account menu items -->
   
   
</div> <!-- class='personal-account' -->
