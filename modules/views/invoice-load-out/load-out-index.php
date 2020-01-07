<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Json;

$this->title = 'Запити на відвантаження';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

	
	<!---- Image ----> 
	 <div class="row"> 
       <center>
	   <div class="col-sm-2 col-xs-6"> 
        <?php		
        $image = '<i class="fa fa-download" style="font-size:56px"></i>';	
        echo "<div class='subfolder border shadowX'>" .
		     Html::a( $image ."<p></p><br>" , ["#"], $options = ["title" => "Sign up requests",]) . 
		     "</div>"; 
	    ?>
       </div>
	   </center>
	</div></br>
	
	
   
	
	<?php
	//pass url to JS for ajax
	$urlX1 = Yii::$app->getUrlManager()->getBaseUrl();
    $this->registerJs( "var urlX = ".Json::encode($urlX1).";",   yii\web\View::POS_HEAD,  'myproduct2-events-script' );
							
							
	//Display all invoices LoadOut with confirmed_by_admin' => self::STATUS_PENDING, ie {0}
	$requestsLoadOut = $modelPageLinker;
	
	if(empty($requestsLoadOut)){
		echo '<div class="col-sm-8 col-xs-12 text-danger"> Запитів немає.</div>';
		
	} else {
		
		echo '<div class="col-sm-8 col-xs-12 text-success"> You have <b class="text-danger">'  . count($requestsLoadOutCount) . ' </b>запитів </div></hr>';
		
		//table headers
		echo '<div class="col-sm-12 col-xs-12  list-group-item header-color">' .
		       '<div class="col-sm-2 col-xs-6"> <b> From </b></div>' .
		       '<div class="col-sm-2 col-xs-6"> <b> Date </b></div>' .
			   //'<div class="col-sm-8 col-xs-6"> <b> Text </b></div>' .
			 '</div>';

		$i = 0;
		foreach($requestsLoadOut as $m){
		    $i++;
			//displays invoices in loop
			echo '<div class="col-sm-12 col-xs-12 list-group-item cursorX invoice-one ' .($i%2 ? 'evenX':''). '" data-toggle="modal" data-target="#myModal' . $i . '" data-invoic-id="' .$m->id . ' " >' .  //data-toggle="modal" data-target="#myModal' . $i .   for modal
			       '<div class="col-sm-2 col-xs-6">' . $m->users->email . '</div>' . //hasOne relation
				   '<div class="col-sm-2 col-xs-6">' . Yii::$app->formatter->format($m->user_date_unix, 'date') .      '</div>' .
				   //'<div class="col-sm-8 col-xs-6">' . crop($m->m_text, 27) .   '</div>' .
				 '</div>';
		?>


		
		 <!--------- Hidden Modal ---------->
		 <!--
           <div class="modal fade" id="myModal<?php echo $i;?>" role="dialog">
               <div class="modal-dialog modal-lg">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title"><i class="fa fa-envelope-open-o" style="font-size:50px; color: navy;"></i> <b> Email</b> </h4>
                       </div>
					   
                      <div class="modal-body">
                          <p><b>Message</b></p>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">From</div>
						      <div class="col-sm-4 col-xs-9"><?=$m->users->email; //hasOne ?></div> 
						  </div>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Date</div>
						      <div class="col-sm-4 col-xs-9"><?=Yii::$app->formatter->format($m->user_date_unix, 'date'); //hasOne?></div> 
						  </div>
						  
						  
					 
                     </div>
					  
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
           </div> -->
          <!------------ End Modal --------------->
		  
		  
		  
		  
		  
       <?php		
				 
		}
		
	
	}
	
	// display LinkPager
    echo LinkPager::widget([
        'pagination' => $pages,
    ]); 
    ?>
	
	
	
	<!-- here goes the div with selected invoice -->
	<div class="col-sm-12 col-xs-12" id="invoiceSelected">
	</div>
	<!-- END here goes the div with selected invoice -->
	
	
	
	
	
	<?php
	function crop($text, $tLenght=33){
	   $length = $tLenght; //? $tLenght : 15; 
	   $text1 = $text; 
	   if(strlen($text1) > $length){
		   $text1 = substr($text1, 0, $length) . "...";
		} 
	   return $text1;
   }
	?>
	
	
</div>
