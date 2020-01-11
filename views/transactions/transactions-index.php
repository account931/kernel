<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use Yii;

$this->title = 'Моя історія';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="all" class="site-about animate-bottom">
    <h1><?= Html::encode($this->title) ?></h1>
	
	
	 <!--- Image -->
	 <div class="row"> 
         <center>
	         <div class="col-sm-2 col-xs-6"> 
             <?php		
             $image = '<i class="fa fa-area-chart" style="font-size:56px"></i>';	
             echo "<div class='subfolder border shadowX'>" .
		     Html::a( $image ."<p></p><br>" , ["#"], $options = ["title" => "My transactions",]) . 
		     "</div>"; 
	         ?>
            </div>
	     </center>
	</div></br>

	
    <!-- Results -->
	<div class="col-sm-12 col-xs-12"> 
	<?php 
	Yii::$app->formatter->locale = 'ru-RU';
	//iterate over merged and manually sorted array
	foreach($query as $key=>$value){
		echo "<div class='col-sm-12 col-xs-12 list-group-item'>";
           
		   //if it is from {invoice_load_out DB} use field {invoice_unique_id}
		   if (isset($value['user_id'])){
			    echo "<div class='bg-danger'>" .
				         "<i class='fa fa-mail-reply' style='font-size:18px'></i><br>" .
       				     " Списано:" . Yii::$app->formatter->asDate($value->date_to_load_out, 'dd-MM-yyyy') . " " .
				         //"User: " . $value['user_id'] . 
				          //$value->users->email . //hasOne
					      " Накладна:<b> " .$value['invoice_unique_id']  . "</b> " . 
						  " Елеватор: <b> " .$value['elevator_id']  . "</b> " . 
						  "<div class='bg-danger'>  - " . $value['product_wieght'] .  " кг " . $value->products->pr_name_name  . " </div>". //-1kg
						  "</div>";
											
		   //if it is from {invoice_load_in DB}	
		   } else {
			   
				echo "<div class='bg-success'>" .
				        "<i class='fa fa-mail-forward' style='font-size:18px'></i><br>" .
        				"Додано : " .Yii::$app->formatter->asDate($value->unix, 'dd-MM-yyyy'). " " .
				        //"User: " . $value['user_kontagent_id'] . 
				        "Накладна:<b>  " . $value['invoice_id'] . " </b>" .  
						" Елеватор: <b> " .$value['elevator_id']  . "</b> " . 
						"<div class='bg-success'>  - " . $value['product_wight'] .  " кг " . $value->products->pr_name_name  . " </div>". //-1kg
						"</div>";
		   }
			 /*
		     foreach($value as $key1=>$value1){ 
			    echo "{$key1} ===> {$value1} ";
		     }*/
		echo "</div><hr>";
	}
	 
	?>
	</div> 
	
	
    
</div>
