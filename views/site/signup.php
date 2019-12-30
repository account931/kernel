<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
 
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
	
	
	<!------ FLASH Message ----->
   <?php if( Yii::$app->session->hasFlash('warnX') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('warnX'); ?>
    </div>
    <?php endif;?>
   <!------ END FLASH  ----->
   
	
    <p>Please fill out the following fields to signup:</p>
	<p>add to DB, model and this form => phone, name, surename, company</p>
    <div class="row">
        <div class="col-lg-5">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'password_confirm')->passwordInput() ?>
				<?= $form->field($model, 'phone_number')->textInput() ?>
				<?= $form->field($model, 'first_name')->textInput() ?>
				<?= $form->field($model, 'last_name')->textInput() ?>
				<?= $form->field($model, 'company_name')->textInput() ?>
				<?= $form->field($model, 'address')->textInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
			<?php Pjax::end(); ?>
 
        </div>
    </div>
</div>