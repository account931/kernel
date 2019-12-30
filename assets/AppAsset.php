<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/myCss.css',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', //awesome fonts
		'css/admin/admin-css.css', //move to admin asset
		'//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', //autocomplete CSS
    ];
    public $js = [
	    'js/loader.js',
		'js/admin/admin_js.js',
		 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', //autocomplete JS
		'js/admin/autocomplete.js', //autocomplete JS
		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
