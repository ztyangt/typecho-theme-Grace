<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 
 *后台外观设置表单构造
 */

class FormLabel extends Typecho_Widget_Helper_Layout{
    public function __construct($html)
    {
        $this->html($html);
        $this->start();
        $this->end();
    }

    public function start(){}
    public function end(){
    }
}

class Grace{
	// 获取版本
	public static function returnVersion(){
        $version = "";
        $themes = null;
        Typecho_Widget::widget('Widget_Themes_List')->to($themes);
        while($themes->next()){
            if ($themes->name == 'Grace'){
                $version = $themes->version;
                break;
            }
        }
        return $version;
    }
	
	// 后台外观页面设置
    public static function Option_nav(){
    	$options = Typecho_Widget::widget('Widget_Options');
        if (!defined('THEME_URL')){
            define("THEME_URL", rtrim(preg_replace('/^'.preg_quote($options->siteUrl, '/').'/', $options->rootUrl.'/', $options->themeUrl, 1),'/').'/');
        }   	
    	$themeUrl = THEME_URL;
        $version = self::returnVersion();
        require_once("backui.php");
    }
    
    public static function Theme_url (){
        $options = Typecho_Widget::widget('Widget_Options');
        if (!defined('THEME_URL')){
            define("THEME_URL", rtrim(preg_replace('/^'.preg_quote($options->siteUrl, '/').'/', $options->rootUrl.'/', $options->themeUrl, 1),'/').'/');
        } 
        $themeUrl = THEME_URL;
        return $themeUrl;
    }

    public static function Style(){
    	$themeUrl = Grace::Theme_url();
        return "
        <link rel=\"stylesheet\" href=\"{$themeUrl}assets/css/backstyle.css\" type=\"text/css\"/>
	    <script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"{$themeUrl}assets/js/sidebar.min.js\" defer></script>
        <script type=\"text/javascript\" src=\"https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js\"></script>
		";
    }
}

