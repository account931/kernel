<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'My Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

	
	<!---- Image ----> 
	 <div class="row"> 
       <center>
	   <div class="col-sm-2 col-xs-6"> 
        <?php		
        $image = '<i class="fa fa-envelope-o" style="font-size:46px"></i>';	
        echo "<div class='subfolder border shadowX'>" .
		     Html::a( $image ."<p></p><br>" , ["#"], $options = ["title" => "Sign up requests",]) . 
		     "</div>"; 
	    ?>
       </div>
	   </center>
	</div></br>
	
	
	
	
    
	
	<?php
	$messages = $modelPageLinker;
	
	if(empty($messages)){
		echo '<div class="col-sm-8 col-xs-12 text-danger"> No messages yet</div>';
		
	} else {
		
		echo '<div class="col-sm-8 col-xs-12 text-success"> You have <b class="text-danger">'  . count($messagesCount) . ' </b>messages </div></hr>';
		
		//table headers
		echo '<div class="col-sm-12 col-xs-12 list-group-item header-color">' .
		       '<div class="col-sm-2 col-xs-2"> <b> From </b></div>' .
		       '<div class="col-sm-2 col-xs-4"> <b> Date </b></div>' .
			   '<div class="col-sm-8 col-xs-6"> <b> Text </b></div>' .
			 '</div>';

		$i = 0;
		foreach($messages as $m){
		    $i++;
			
			echo '<div class="col-sm-12 col-xs-12  list-group-item bg-success cursorX ' .($i%2 ? 'evenX':''). '" data-toggle="modal" data-target="#myModal' . $i . '">' .  //data-toggle="modal" data-target="#myModal' . $i .   for modal
			       '<div class="col-sm-2 col-xs-3 word-breakX">' . $m->users->email . '</div>' . //hasOne relation
				   '<div class="col-sm-2 col-xs-4">' . $m->m_time .      '</div>' .
				   '<div class="col-sm-8 col-xs-5">' . crop($m->m_text, 27) .   '</div>' .
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
						      <div class="col-sm-4 col-xs-9"><?=$m->m_time;?></div> <!-- has one -->
						  </div>
						  
						  <div class="row list-group-item">
						      <div class="col-sm-1 col-xs-3">Email</div>
						      <div class="col-sm-8 col-xs-9"><?=$m->m_text;?></div>
						  </div>  
					 
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
	
	
	// display LinkPager
    echo LinkPager::widget([
       'pagination' => $pages,
    ]); 
	
	
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