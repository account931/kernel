<?php

use yii\helpers\Html;
use yii\helpers\Json;


/* @var $this yii\web\View */
/* @var $model app\modules\models\InvoiceLoadIn */

$this->title = 'Створити нову накладну';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Load Ins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-load-in-create">

    <h1><?= Html::encode($this->title) ?>
	<i class="fa fa-folder-open-o" style="font-size:34px"></i></h1>
	
	
	
	<?php
	//passing php obj to autocomplete.js
    $this->registerJs(
           "var usersX = ".Json::encode($allUsers).";", 
           yii\web\View::POS_HEAD, 
           'calender-events-script'
     );
	 //End passing php obj to autocomplete.js-
	 ?>
	 
	 

    <?= $this->render('_form', [
        'model' => $model,
		'products' => $products,
		'elevators' => $elevators
    ]) ?>

</div>
