<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
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

	
    
</div>
