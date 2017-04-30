<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/slider-style.css',
        'css/registration.css',
        'css/contact.css',
        'css/view-profile.css',
        'css/view-full-post.css',
        'css/modal-messages.css',
        'css/comment-view.css'
    ];
        public $js = [
            'js/slide-show.js',
            'js/test.js'
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
