<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use Yii;

$this->title = 'Переоформити';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="all" class="site-about animate-bottom">
    <h1><?= Html::encode($this->title) ?></h1>
	<p>Переоформити зерно на іншого користувача</p>
	
	
	 <!--- Image -->
	 <div class="row"> 
         <center>
	         <div class="col-sm-2 col-xs-6"> 
             <?php		
             $image = '<i class="fa fa-balance-scale" style="font-size:56px"></i>';	
             echo "<div class='subfolder border shadowX'>" .
		     Html::a( $image ."<p></p><br>" , ["#"], $options = ["title" => "My transactions",]) . 
		     "</div>"; 
	         ?>
            </div>
	     </center>
	</div></br>

	
	
	
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	
	

 
</div>
