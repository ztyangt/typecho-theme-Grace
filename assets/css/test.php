<?php
$str = 'a:31:{s:7:"faviconho.test/usr/themes/Grace/img/favicon.ico";s:5:"logo1";s:50:"http://typecho.test/usr/themes/Grace/img/logo1.png";s:5:"logo2";s:50:"http://typecho.test/usr/themes/Grace/img/logo2.png";s:10:"maincolor1";s:7:"#f33c6e";s:6:"avatar";s:54:"http://typecho.test/usr/themes/Grace/img/no-avatar.png";s:8:"coverimg";s:55';


$p = strpos($str,'maincolor1');
$str1 = substr_replace($str,'张同阳',$p + 18,6);
echo $str1;

