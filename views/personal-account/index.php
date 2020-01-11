<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Collapse;  //  Collapse (hide/show)

$this->title = 'особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="all" class="site-about animate-bottom personal-account">
    <h1><?= Html::encode($this->title) ?></h1>
	
	<! -- Delete in production -->
	<p class="text-danger small">Pretty URL + fix url for ajax in admin (display number of reg requestd)</p>
    <! -- Delete in production -->
	
    <p><i class="fa fa-drivers-license-o" style="font-size:14px"></i> Welcome, <?=Yii::$app->user->identity->username;?> </p>
	<hr>
	<p> На Вашому балансі : 
	    <?php
		    //display user's balance
		    if(!$balance){
			    echo " <b>0</b> <i>(you seem to have nothing on your balance so far).</i>";
				
		    } else {
		        
		        foreach ($balance as $k){
					echo "<div class='row'>";
				    echo "<div class='col-sm-2 col-xs-5'><i class='fa fa-shopping-basket' style='font-size:16px'></i> " . 
					                                            $k->productname->pr_name_name . ":</div>" . //hasOne relation
						 "<div class='col-sm-1 col-xs-2'><b>" . $k->balance_amount_kg . "</b>" . " " .      //weight
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
            'label' => 'Ваш аккаунт',
            'content' => '   
                        <div class="col-lg-offset-1" style="color:;">
						 <i class="fa fa-address-card-o" style="font-size:36px"></i></br>
                         <p><b>Деталі Вашаго аккаунту</b>.</p>
						 <p>Username: '. Yii::$app->user->identity->username . '</p>
						 <p>Email: '. Yii::$app->user->identity->email . '</p>
						 <p>Name: '. Yii::$app->user->identity->first_name . '</p>
						 <p>Last name: '. Yii::$app->user->identity->last_name . '</p>
						 <p>Company: '. Yii::$app->user->identity->company_name . '</p>
						 <p>Phone: '. Yii::$app->user->identity->phone_number . '</p>
						 <p>Address: '. Yii::$app->user->identity->address . '</p>
                       </div>',
            // to  be  this  block open  by  default de-comment  the  following 
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
			        Html::a( $image ."<p>Вiдвантажити</p><br>", ["/invoice-load-out/load-out" ] , $options = ["title" => "Load out",]) . 
		            "</div>"; 
				?>
           </div>
	   
	       <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-balance-scale" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX lavender'>" .
			        Html::a( $image ."<p>Переоформити</p><br>" , ["/site/login" ], $options = ["title" => "Renew",]) . 
		            "</div>";
                 ?>
            </div>
			
			<div class="col-sm-2 col-xs-6 badge1 bb " data-badge="N/A"">
                <?php		
                $image = '<i class="fa fa-envelope-o" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX lavender'>" .
			        Html::a( $image ."<p>Повiдомлення</p><br>" , ["/messages/show-messages" ], $options = ["title" => "messages",]) . 
		            "</div>";
                 ?>
            </div>
			
	        <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-automobile" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX lavender'>" .
			        Html::a( $image ."<p>View my transport</p><br>" , ["/site/login",] , $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
	   
	        
			 <div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-area-chart" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Транзакції</p><br>" , ["/transactions/mytransations"], $options = ["title" => "History",]) . 
		            "</div>";
                 ?>
            </div>
			
			<div class="col-sm-2 col-xs-6">
                <?php		
                $image = '<i class="fa fa-comments-o" style="font-size:96px"></i>';	
                echo "<div class='subfolder border shadowX'>" .
			        Html::a( $image ."<p>Бот помiчник</p><br>" , ["#"] /* $url = null*/, $options = ["title" => "more  info",]) . 
		            "</div>";
                 ?>
            </div>
			
   </div><!-- class='row' -->
   <!-- End Personal account menu items -->
   
   
</div> <!-- class='personal-account' -->
