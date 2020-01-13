<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Json;

$this->title = 'Запити на відвантаження';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	
   <!------ FLASH Message if OK ----->
   <?php if( Yii::$app->session->hasFlash('statusOK') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('statusOK'); ?>
    </div>
    <?php endif;?>
   <!------ END FLASH if OK ----->
   
   
      <!------ FLASH Message if FAILS ----->
   <?php if( Yii::$app->session->hasFlash('statusFAIL') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('statusFAIL'); ?>
    </div>
    <?php endif;?>
   <!------ END FLASH if FAILS ----->

	
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
	
	//pass elevators to JS for ajax to build dropdown with elevators
    $this->registerJs( "var elevators = ".Json::encode($allElevators).";",   yii\web\View::POS_HEAD,  'myproduct3-events-script' );	
    					
							
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
	
	
	
	
	<!----------------- Div with selected invoice's details and datepicker (html-ed with ajax) ------------>
	<div class="col-sm-12 col-xs-12" id="invoiceSelected">
	</div>
	<!------------- END Div with selected invoice's details and datepicker (html-ed with ajax)  ------------>
	
	
	
	
	<!----------------- Div with Interval list (free/taken) (html-ed with ajax) ------------>
	<div class="col-sm-12 col-xs-12" id="intervalList">

	</div>
	<!------------- Div with Interval list (html-ed with ajax)  ------------>
	
	
	
    </br>
	
	
	<!----------------- Div with hidden form (where Admin sets date to loadOut, hour & minutes)  ------------>
	<div class="col-sm-12 col-xs-12" id="formFinish"> 
	
	    <div class="col-sm-12 col-xs-12 text-danger"><!-- this div to display selected date, hour, min, html-ed in js/datepicker_action.js -->
		    <center><h3  class="borderZ" id="selDate"></h3></center>
		</div> 
	
	    <?php $form = ActiveForm::begin(); ?>
	
	     <div class="col-sm-4 col-xs-12">
	    <?= $form->field($model, 'id')->textInput([ 'placeholder' => 'invoice ID', 'id' => 'invoiceID' , 'type' => 'number' ])->label('Invoice ID'); ?>
	    </div>
		
        <div class="col-sm-4 col-xs-12">
	    <?= $form->field($model, 'confirmed_date_unix')->textInput([ 'placeholder' => 'Confirm date', 'value'=> time(), 'type' => 'number' ]); ?>
	    </div>
	
	    <div class="col-sm-4 col-xs-12">
        <?= $form->field($model, 'date_to_load_out')->textInput([ 'placeholder' => 'Date to load', 'id' => 'dateToLoad', 'type' => 'number']) ?> 
        </div>
	
	    <div class="col-sm-4 col-xs-12">
        <?= $form->field($model, 'b_intervals')->textInput(['placeholder' => 'Hour', 'id' => 'intervalHour']) ?>
        </div>
	
	    <div class="col-sm-4 col-xs-12">
	    <?= $form->field($model, 'b_quarters')->textInput(['placeholder' => 'Minute', 'id' => 'quarterMinute']); ?>
	    </div>
	
	    <div class="col-sm-4 col-xs-12">
	    <?= $form->field($model, 'elevator_id')->textInput(['placeholder' => 'Elevator', 'id' => 'elevator', 'type' => 'number']); ?>
	    </div>
	
	    <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
	    </div>

       <?php ActiveForm::end(); ?>
	</div>
	<!------------- END Div with hidden form   ------------>

	
	
	

	
	<!------------- Loader for ajax waiting time ------------>
	<div class="loader" id="loader"></div>
	<!------------- Loader for ajax waiting time ------------>
	
	
</div>



<?php
//DELETE?????
/*
$this->registerJsFile(
    '@web/js/jqueryX.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
     '@web/js/datepicker_ui/datepicker.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
*/
?>





