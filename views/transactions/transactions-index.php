<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

$this->title = 'Моя історія';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="all" class="site-about animate-bottom">

    
	
    <h1><?= Html::encode($this->title) ?></h1>
	
	<div class="row">
	
	    <div class="col-sm-6 col-xs-12"><!-- left-->
	
	        <!--- Image -->
	        <div class="row"> 
                <center>
	                <div class="col-sm-4 col-xs-6"> 
                        <?php		
                        $image = '<i class="fa fa-area-chart" style="font-size:56px"></i>';	
                        echo "<div class='subfolder border shadowX'>" .
		                Html::a( $image ."<p></p><br>" , ["#"], $options = ["title" => "My transactions",]) . 
		                "</div>"; 
	                    ?>
                    </div>
	            </center>
	        </div></br>
	
	    </div><!-- left-->
	
	
	
	   <div class="col-sm-6 col-xs-6"><!-- right div ith DropDown -->
	      <select id="dropdownnn"><!-- triggered with js -->
			<?php  
             $selectStatus = 'selected="selected"'; 			
			 echo '<option value="' . Url::to(["transactions/mytransations"]) . '"' . ((!isset($_GET['period'])) ? $selectStatus:'')  . '> За весь час </option>';
             echo '<option value="' . Url::to(["transactions/mytransations", "period" => "currentMonth"]) . '"' . ((isset($_GET['period']) && $_GET['period'] == "currentMonth") ? $selectStatus:'')  . '> Поточний місяць </option>';
             echo '<option value="' . Url::to(["transactions/mytransations", "period" => "lastMonth"])    . '"' . ((isset($_GET['period']) && $_GET['period'] == "lastMonth") ? $selectStatus:'')  . '> Попередній місяць </option>';
             echo '<option value="' . Url::to(["transactions/mytransations", "period" => "last_6_Month"]) . '"' . ((isset($_GET['period']) && $_GET['period'] == "last_6_Month") ? $selectStatus:'')  . '> Останні півроку </option>';		 
			?>


		  </select>
	  </div><!-- right -->
    
	</div><!-- row-->
	
	
	
    <!-- Results -->
	<?php
	if(empty($query)){
		echo '<div class="col-sm-8 col-xs-12 text-danger"> Поки що жодних транзакцій</div>';
		
	} else {
		
		//define $period
		if (!Yii::$app->getRequest()->getQueryParam('period')){
			$period = ' за весь час';
		}
		if (Yii::$app->getRequest()->getQueryParam('period') == "currentMonth"){
			$period = ' за поточний місяць';
		}
		if (Yii::$app->getRequest()->getQueryParam('period') == "lastMonth"){
			$period = ' за минулий місяць';
		}
		if (Yii::$app->getRequest()->getQueryParam('period') == "last_6_Month"){
			$period = ' за останнні 6 місяців';
		}
			
		echo '<div class="col-sm-8 col-xs-12 text-success"> У Вас  <b class="text-danger">'  . count($query) . ' </b> транзакцій ' . $period  . '</div><hr>';
	
	?>
	
	    <div class="col-sm-12 col-xs-12"> 
	    <?php 
		//date_default_timezone_set('Europe/Kiev');
	    $i = 0;
	    //iterate over merged and manually sorted array
	    foreach($query as $key=>$value){
		    $i++;
		    echo "<div class='col-sm-12 col-xs-12 list-group-item'>";
           
		       //if it is from {invoice_load_out DB} use field {invoice_unique_id}
		       if (isset($value['user_id'])){
			       echo "<div class='bg-danger cursorX' data-toggle='modal' data-target='#myModalHistory" . $i ."'>" .   
				         "<i class='fa fa-mail-reply' style='font-size:18px'></i><br>" . 
						 "<b>" . date("d-m-Y H:i:s", $value->user_date_unix) . "</b><br>".  //unix hen user make request
						 //"<b>" .Yii::$app->formatter->asDate($value->date_to_load_out, 'dd-MM-yyyy H:i:s') . "</b><br>" .
       				     " Списано. " . //Yii::$app->formatter->asDate($value->date_to_load_out, 'dd-MM-yyyy H:i:s ') . "<br>" .
				          //$value->users->email . //hasOne
					      " Накладна:<b> " .$value['invoice_unique_id']  . "</b> " . 
						  " Елеватор: <b> " .$value['elevator_id']  . "</b> " . 
						  "Відвантаження: <b>" . date("d-m-Y H:i:s", $value->date_to_load_out) . "</b>" .
						  " Статус: OK" .
						  "<div class='bg-danger'>  - " . $value['product_wieght'] .  " кг " . $value->products->pr_name_name  . " </div>". //-1kg
						  "</div>";
				
				
                   //text for modal				
	               $text =  '<div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Накладна:</div>
						      <div class="col-sm-4 col-xs-9">' . $value['invoice_unique_id'] . '</div> 
						  </div>
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Дата:</div>
						      <div class="col-sm-4 col-xs-9">' .Yii::$app->formatter->asDate($value->date_to_load_out, 'dd-MM-yyyy H:i') . '</div> 
						  </div>
						   <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Списано :</div>
						      <div class="col-sm-4 col-xs-9"> - ' . $value['product_wieght'] .  " кг " . $value->products->pr_name_name . '</div> 
						  </div>';
						  
								
		       //if it is from {invoice_load_in DB}	
		       } else {
			   
				    echo "<div class='bg-success cursorX' data-toggle='modal' data-target='#myModalHistory" . $i ."'>" . 
				        "<i class='fa fa-mail-forward' style='font-size:18px'></i><br>" .
						//"<b>" . Yii::$app->formatter->asDate($value->unix, 'dd-MM-yyyy H:i') . "</b><br>" .
						"<b>" . date("d-m-Y H:i:s", $value->unix) . "</b><br>".
        				"Додано. " . 
				        "Накладна:<b>  " . $value['invoice_id'] . " </b>" .  
						" Елеватор: <b> " .$value['elevator_id']  . "</b> " . 
						"<div class='bg-success'>  + " . $value['product_wight'] .  " кг " . $value->products->pr_name_name  . " </div>". //-1kg
						"</div>";
				
				
                   //text for modal				
	               $text =  '<div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Накладна:</div>
						      <div class="col-sm-4 col-xs-9">' . $value['invoice_id'] . '</div> 
						  </div>
                         <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Дата:</div>
						      <div class="col-sm-4 col-xs-9">' .Yii::$app->formatter->asDate($value->unix, 'dd-MM-yyyy H:i') . '</div> 
						  </div>
                           <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Додано :</div>
						      <div class="col-sm-4 col-xs-9"> + ' . $value['product_wight'] .  " кг " . $value->products->pr_name_name . '</div> 
						  </div>';						  

		       }
		
		      echo "</div><hr>";
		      ?>
			  
		      <!--------- Hidden Modal ---------->
              <div class="modal fade" id="myModalHistory<?php echo $i;?>" role="dialog">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title"><i class="fa fa-line-chart" style="font-size:50px; color: navy;"></i> <b> Деталі</b> </h4>
                         </div>
					   
                        <div class="modal-body">
                            <p><b>Message</b></p>
						    <?=$text;?>    
                        </div>
					  
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
             </div>
            <!------------ End Modal ---------------> 
		  
		    <?php
	      } 
	}
	?>		  
		  
	</div> 
 
</div>
