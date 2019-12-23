<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Welcome to Kernel';
?>
<div class="site-index">

    <div class="jumbotron shadowX">
        <h1>Welcome to Kernel</h1>
		<?=Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/kernel.jpg' , $options = ["id"=>"","margin-left"=>"3%","class"=>"","width"=>"10%","title"=>"Kernel"] ); ?>
    </div>

	
    <div class="body-content">
	
        <div class="row log-reg"> 
            <center>
			<div class="col-sm-4 col-xs-0"></div>
		    <!-- Login -->
		    <div class="col-sm-2 col-xs-6">
			<?php
			    $image = '<i class="fa fa-address-card-o" style="font-size:96px"></i>';	
				 echo "<div class='subfolder border shadowX'>" .
			             Html::a( $image ."<p>Sign in</p><br>" , ["/site/login", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
				      "</div>";
			?>
			</div>
			
			<!-- Registration -->
			<div class="col-sm-2 col-xs-6">
			<?php
			    $image = '<i class="fa fa-user-plus" style="font-size:96px"></i>';	
				 echo "<div class='subfolder border shadowX'>" .
			             Html::a( $image ."<p>Sign up</p><br>" , ["/site/folder-gallery", "traceFolder" => $folderName,   ] /* $url = null*/, $options = ["title" => "more  info",]) . 
				      "</div>";
			?>
			</div>
			</center>
		</div> <!--class="log-reg" -->
        

    </div>
</div>
