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
    ];
	
    public $js = [
	    'js/admin/admin_js.js',
	    //'js/admin/ajax_count_reg_request.js',
		'js/admin/invoice_load_out.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
