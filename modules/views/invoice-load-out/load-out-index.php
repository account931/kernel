<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Запити на відвантаження';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

	<div class="col-sm-8 col-xs-12">
	
      <p>
	     <i class="fa fa-download" style="font-size:110px; color: navy;"></i>
      </p>
    </div>
    
	
	<?php
	if(empty($requestsLoadOut)){
		echo '<div class="col-sm-8 col-xs-12 text-danger"> Запитів немає.</div>';
		
	} else {
		
		echo '<div class="col-sm-8 col-xs-12 text-success"> You have <b class="text-danger">'  . count($requestsLoadOut) . ' </b>запитів </div></hr>';
		
		//table headers
		echo '<div class="col-sm-12 col-xs-12 border list-group-item">' .
		       '<div class="col-sm-2 col-xs-2"> <b> From </b></div>' .
		       '<div class="col-sm-2 col-xs-4"> <b> Date </b></div>' .
			   //'<div class="col-sm-8 col-xs-6"> <b> Text </b></div>' .
			 '</div>';

		$i = 0;
		foreach($requestsLoadOut as $m){
		    $i++;
			
			echo '<div class="col-sm-12 col-xs-12 border list-group-item bg-success cursorX" data-toggle="modal" data-target="#myModal' . $i . '">' .  //data-toggle="modal" data-target="#myModal' . $i .   for modal
			       '<div class="col-sm-2 col-xs-2">' . $m->users->email . '</div>' . //hasOne relation
				   '<div class="col-sm-2 col-xs-4">' . $m->user_date_unix .      '</div>' .
				   //'<div class="col-sm-8 col-xs-6">' . crop($m->m_text, 27) .   '</div>' .
				 '</div>';
		?>


		
		 <!--------- Hidden Modal ---------->
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
						      <div class="col-sm-4 col-xs-9"><?=$m->users->email;?></div> <!-- has one -->
						  </div>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Date</div>
						      <div class="col-sm-4 col-xs-9"><?=$m->user_date_unix;?></div> <!-- has one -->
						  </div>
						  
						  <!--<div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Email</div>
						      <div class="col-sm-8 col-xs-9"><?//=$m->m_text;?></div>
						  </div>  -->
					 
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
