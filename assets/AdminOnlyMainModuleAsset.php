<?php
/**
 * 
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 */
class AdminOnlyMainModuleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
	   'css/admin/admin-css.css', //move to admin asset
	   'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css', //Sweet Alert CSS
	   
	   'css/datepicker_ui/datepicker.min.css', //datepicker UI Lib CSS
	   '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',


	   
    ];
	
    public $js = [
		'js/admin/admin_js.js',
		'js/admin/invoice_load_out.js', //ajax to loadOut
		'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js', //Sweet Alert JS
		'js/admin/datepicker_actions.js', //my datepicker
	    //'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js',
	    //'js/jqueryX.min.js',
	    //'//code.jquery.com/ui/1.11.4/jquery-ui.js',
		//'js/datepicker_ui/datepicker.min.js', //datepicker UI Lib JS  
		//'js/datepicker_ui/datepicker.js',
		
		
		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
