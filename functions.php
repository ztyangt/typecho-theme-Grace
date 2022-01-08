<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once("libs/Options.php");

if(is_array(Helper::options()->notice)) {
    if (in_array("StmpPush", Helper::options()->notice)) {
        require_once("notice/Mail/Send.php");
    }
    if (in_array('QmsgPush', Helper::options()->notice)) {
        require_once("notice/Qmsg/Send.php");
    }
}


//全站中文字符统计
function allOfCharacters()
{
    $showPrivate = intval($pluginOpts->showPrivate);
    $chars = 0;
    $db = Typecho_Db::get();
    if ($showPrivate == 0) {
        $select = $db->select('text')->from('table.contents')->where('table.contents.status = ?', 'publish');
    } else {
        $select = $db->select('text')->from('table.contents');
    }
    $rows = $db->fetchAll($select);
    foreach ($rows as $row) {
        $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $row['text']); //过滤中文
        $chars += mb_strlen($text, 'UTF-8');
    }
    $unit = '';
    if ($chars >= 10000) {
        $chars /= 10000;
        $unit = 'w';
    } else if ($chars >= 1000) {
        $chars /= 1000;
        $unit = 'k';
    }
    $out = sprintf('%.2lf %s', $chars, $unit);
    echo $out;
}

function art_count($cid)
{
    $db = Typecho_Db::get();
    $rs = $db->fetchRow($db->select('table.contents.text')->from('table.contents')->where('table.contents.cid=?', $cid)->order('table.contents.cid', Typecho_Db::SORT_ASC)->limit(1));
    $rel_text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($rel_text, 'UTF-8');
}

function slide_ctrl()
{
    $db = Typecho_Db::get();
    $query = $db->select('cid')->from('table.fields')->where('str_value = ?', 'Yes')->where('name = ?', 'slide');
    $result = $db->fetchAll($query);
    return $result;
}

// 封面获取
function showCover($widget)
{
    $options = Typecho_Widget::widget('Widget_Options');
    if (($widget->fields->cover)) {
        $img = $widget->fields->cover;
    } else {
        $img = $options->coverimg;
    }
    return $img;
}

// 随机短句
function duanju()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $arr = file($options->themeUrl('/assets/word.txt', "Grace"));
    $n = rand(0, count($arr) - 1);
    echo $arr[$n];
}
// 十六进制 转 RGB
  function hex2rgb($hexColor) {
    $color = str_replace('#', '', $hexColor);
    if (strlen($color) > 3) {
      $rgb = array(
        'r' => hexdec(substr($color, 0, 2)),
        'g' => hexdec(substr($color, 2, 2)),
        'b' => hexdec(substr($color, 4, 2))
      );
    } else {
      $color = $hexColor;
      $r = substr($color, 0, 1) . substr($color, 0, 1);
      $g = substr($color, 1, 1) . substr($color, 1, 1);
      $b = substr($color, 2, 1) . substr($color, 2, 1);
      $rgb = array(
        'r' => hexdec($r),
        'g' => hexdec($g),
        'b' => hexdec($b)
      );
    }
    return $rgb;
  }
  // rgb转16进制
function rgb2hex($rgb){
    $regexp = "/^rgb\(([0-9]{0,3})\,\s*([0-9]{0,3})\,\s*([0-9]{0,3})\)/";
    $re = preg_match($regexp, $rgb, $match);
    $re = array_shift($match);
    $hexColor = "#";
    $hex = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');
    for ($i = 0; $i < 3; $i++) {
      $r = null;
      $c = $match[$i];
      $hexAr = array();
      while ($c > 16) {
        $r = $c % 16;
        $c = ($c / 16) >> 0;
        array_push($hexAr, $hex[$r]);
      }
      array_push($hexAr, $hex[$c]);
      $ret = array_reverse($hexAr);
      $item = implode('', $ret);
      $item = str_pad($item, 2, '0', STR_PAD_LEFT);
      $hexColor .= $item;
    }
    return $hexColor;
  }
// 判断时间范围
function Time_range()
{
    $time = time();
    $newtime = date('Y-m-d');
    $ctime = strtotime(date($newtime . '20:00' . ':00'));
    $etime = strtotime(date($newtime . '08:00' . ':00'));
    if ($time >= $ctime || $time <= $etime) {
        return true;
    } else {
        return false;
    }
}
// 昼夜模式切换
function Switch_day()
{
    if (Time_range()) {
        setcookie("auto_night", "1");
        return true;
    } else {
        setcookie("auto_night", "0");
        // setcookie('auto_night', "",time()-3660);
        return false;

    }
}

// 获取置顶文章
function getTopPost(){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select('cid')->from('table.fields')
        ->where('name = ?','topPost')
        ->where('str_value = ?', 'Yes')
        ->order('cid', Typecho_Db::SORT_DESC)
    );
    $postArr = array();
    foreach ($result as $post) {
        $postArr[] = $post['cid'];
    }
    return $postArr;
}
// 获取最近更新
function recentUpdate($limit){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select('cid')->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('password is NULL')
        ->where('created <= unix_timestamp(now())', 'post') 
        ->limit($limit)
        ->order('modified', Typecho_Db::SORT_DESC)
    );
    return $result;
}
// 获取热门评论文章
function getHotcomts($limit){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select('cid')->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('password is NULL')
        ->where('created <= unix_timestamp(now())', 'post') 
        ->limit($limit)
        ->order('commentsNum', Typecho_Db::SORT_DESC)
    );
    return $result;
}
// 获取浏览量前十文章
function getHotviews($limit){
    $db = Typecho_Db::get();
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    $result = $db->fetchAll($db->select('cid')->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('password is NULL')
        ->where('created <= unix_timestamp(now())', 'post') 
        ->limit($limit)
        ->order('views', Typecho_Db::SORT_DESC)
    );
    return $result;
}

// 随机文章
function random_posts($limit){
    $db = Typecho_Db::get();
    $rand = "RAND()";
    if (stripos($db->getAdapterName(), 'sqlite') !== false) {
        $rand = "RANDOM()";
    }

    $suery = $db->select()->from('table.contents')
        ->where('status = ?', 'publish')
        ->where('type = ?', 'post')
        ->where('password is NULL')
        ->where('created <= ' . Helper::options()->gmtTime, 'post') 
        ->limit($limit)
        ->order($rand);
    $result = $db->fetchAll($suery);
    return $result;
}
function getUpdateTime($cid){
    $db = Typecho_Db::get();
    $time = $db->fetchAll($db->select('modified')->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('cid = ?', $cid)
    )[0]['modified'];
    return $time;
}

// 文章浏览量统计
function Postviews($archive) {

    $db = Typecho_Db::get();
    $cid = $archive->cid;
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    $views = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
    if ($archive->is('single')) {
        $cookie = Typecho_Cookie::get('contents_views');
        $cookie = $cookie ? explode(',', $cookie) : array();
        if (!in_array($cid, $cookie)) {
            $db->query($db->update('table.contents')
                ->rows(array('views' => (int)$views+1))
                ->where('cid = ?', $cid));
            $views = (int)$views+1;
            array_push($cookie, $cid);
            $cookie = implode(',', $cookie);
            Typecho_Cookie::set('contents_views', $cookie,time()+60 * 20);
        }
    }
}

// 文章浏览量查询
function getViews($cid){
    $db = Typecho_Db::get();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    $views = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
    return $views;
}

// 多少天前
function timesince($older_date)
{
    if ($older_date == "no") {
        return;
    }
    $chunks = array(
        array(86400, ' 天'),
        array(3600, ' 小时'),
        array(60, ' 分'),
        array(1, ' 秒'),
    );
    $newer_date = time();
    $since = abs($newer_date - $older_date);
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) break;
    }
    $output = $count . $name . '前';
    return $output;
}

// 计算时间差
function time_diff($start)
{
    $datetime_start = new DateTime(date("Y-m-d", $start));
    $datetime_end = new DateTime(date("Y-m-d", time()));
    $days = $datetime_start->diff($datetime_end)->days;
    if($days > 30){
        return date('Y-m-d',$start);
    }else{
        return timesince($start);
    }
}
// 加载动画选择
function loadingStyle($style1,$style2){
    if($style1 == $style2){
        echo "loading-show";
    }else{
        echo "loading-hidden";
    }
}

// 页面加载耗时
function timer_start() {
	global $timestart;
	$mtime     = explode( ' ', microtime() );
	$timestart = $mtime[1] + $mtime[0];
	return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
	global $timestart, $timeend;
	$mtime     = explode( ' ', microtime() );
	$timeend   = $mtime[1] + $mtime[0];
	$timetotal = number_format( $timeend - $timestart, $precision );
	$r         = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
	if ( $display ) {
		echo $r;
	}
	echo $r;
}
// 网站运行时间
date_default_timezone_set('Asia/Shanghai');
function getBuildTime(){
	$settime = Typecho_Widget::widget('Widget_Options')->settime;
	$site_create_time = strtotime($settime);
    $time = time() - $site_create_time;
	if(is_numeric($time)){
		$value = array(
		"years" => 0, "days" => 0, "hours" => 0,
		"minutes" => 0, "seconds" => 0,
    );
	if($time >= 31556926){
		$value["years"] = floor($time/31556926);
		$time = ($time%31556926);
    }
	if($time >= 86400){
		$value["days"] = floor($time/86400);
		$time = ($time%86400);
    }
	if($time >= 3600){
		$value["hours"] = floor($time/3600);
		$time = ($time%3600);
	}
	if($time >= 60){
		$value["minutes"] = floor($time/60);
		$time = ($time%60);
	}
	$value["seconds"] = floor($time);}
	$time_arr = array();
	$time1 =  '<span class="btime">'.$value['years'].'年'.$value['days'].'天'.$value['hours'].'小时</span>';
	echo $time1;
}

function getContent($cid){
    $db = Typecho_Db::get();
    $select = $db->select('text')->from('table.contents')->where('cid = ?', $cid);
    $content =  $db->fetchRow($select)['text'];
    return $content;
}

// 文章点赞
function ThumbUp($cid) {
    $db = Typecho_Db::get();
    $ThumbUp = $db->fetchRow($db->select('table.contents.ThumbUp')->from('table.contents')->where('cid = ?', $cid));
    $ThumbUpRecording = Typecho_Cookie::get('typechoThumbUpRecording');
    if (empty($ThumbUpRecording)) {
        Typecho_Cookie::set('typechoThumbUpRecording', json_encode(array($cid)));
    }else {
        $ThumbUpRecording = json_decode($ThumbUpRecording);
        if (in_array($cid, $ThumbUpRecording)) {
            return $ThumbUp['ThumbUp'];
        }
        array_push($ThumbUpRecording, $cid);
        Typecho_Cookie::set('typechoThumbUpRecording', json_encode($ThumbUpRecording));
    }
    $db->query($db->update('table.contents')->rows(array('ThumbUp' => (int)$ThumbUp['ThumbUp'] + 1))->where('cid = ?', $cid));
    $ThumbUp = $db->fetchRow($db->select('table.contents.ThumbUp')->from('table.contents')->where('cid = ?', $cid));
    return $ThumbUp['ThumbUp'];
}

// 获取文章点赞数
function getThumbUps($cid) {
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();

    if (!array_key_exists('ThumbUp', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `ThumbUp` INT(10) NOT NULL DEFAULT 0;');
    }
    $ThumbUp = $db->fetchRow($db->select('table.contents.ThumbUp')->from('table.contents')->where('cid = ?', $cid));
    $ThumbUpRecording = Typecho_Cookie::get('typechoThumbUpRecording');
    if (empty($ThumbUpRecording)) {
        Typecho_Cookie::set('typechoThumbUpRecording', json_encode(array(0)));
    }
    return array(
        'ThumbUp' => $ThumbUp['ThumbUp'],
        'recording' => in_array($cid, json_decode(Typecho_Cookie::get('typechoThumbUpRecording')))?true:false
    );
}


function echart_data($data_arr) {
    $data_arr = array_reverse($data_arr);
    $time1 = strtotime('-1 month',strtotime($data_arr[0])); 
    $time2 = strtotime($data_arr[count($data_arr)-1]);
    $monstr = "";
    $monarr = array();
    while( ($time1 = strtotime('+1 month',$time1)) <= $time2){
        $monarr[] = date('Y-m',$time1); 
        $monstr .= date('Y-m',$time1) .','; 
    }
    $monstr = substr($monstr,0,strlen($monstr)-1);
    $sarr = array_count_values($data_arr);
    $numstr = "";
    for ($i=0;$i<count($monarr);$i++){
        if($sarr[$monarr[$i]]){
            $numstr .= $sarr[$monarr[$i]].',';
        }else{
            $numstr .= '0'.',';
        }
    }
    $numstr = substr($numstr,0,strlen($numstr)-1);
    $earry = array();
    array_push($earry,$monstr,$numstr);
    return $earry;
    }
// 主题颜色设置
function themeColor($color) {
    $db = Typecho_Db::get();
    $db->query($db->update('table.options')->rows(array('value' => $color))->where('name = ?', 'Color:Grace'));
}
function getThemeColor(){
    $db = Typecho_Db::get();
    if(!$db->fetchRow($db->select('value')->from('table.options')->where('name = ?', 'Color:Grace'))){
        $insert = $db->query($db->insert('table.options')->rows(array('name' => 'Color:Grace','value' => '#000000')));
        }
    $themeColor = $db->fetchRow($db->select('value')->from('table.options')->where('name = ?', 'Color:Grace'))['value'];
    return $themeColor;
}
// 文章属性设置
function Postset($cid,$indent,$slide,$topPost,$title,$cover,$keyword,$desc){
    $options = Typecho_Widget::widget('Widget_Options');
    $default_cover = $options->coverimg;
    $db = Typecho_Db::get();
    if(!empty($db->fetchRow($db->select('name')->from('table.fields')->where('cid = ?', $cid)->where('name = ?', 'indent')))){$db->query($db->update('table.fields')->rows(array('str_value' => $indent))->where('cid = ?', $cid)->where('name = ?','indent'));}else{$db->query($db->insert('table.fields')->rows(array('cid' => $cid,'name' => 'indent', 'str_value' => $indent)));  }
    if(!empty($db->fetchRow($db->select('name')->from('table.fields')->where('cid = ?', $cid)->where('name = ?', 'slide')))){
        $db->query($db->update('table.fields')->rows(array('str_value' => $slide))->where('cid = ?', $cid)->where('name = ?','slide'));}else{$db->query($db->insert('table.fields')->rows(array('cid' => $cid,'name' => 'slide', 'str_value' => $slide)));}
    if(!empty($db->fetchRow($db->select('name')->from('table.fields')->where('cid = ?', $cid)->where('name = ?', 'topPost')))){$db->query($db->update('table.fields')->rows(array('str_value' => $topPost))->where('cid = ?', $cid)->where('name = ?','topPost'));}else{$db->query($db->insert('table.fields')->rows(array('cid' => $cid,'name' => 'topPost', 'str_value' => $topPost)));}
    $db->query($db->update('table.contents')->rows(array('title' => $title))->where('cid = ?', $cid));  
    $db->query($db->update('table.fields')->rows(array('str_value' => $cover))->where('cid = ?', $cid)->where('name = ?','cover'));    
    $db->query($db->update('table.fields')->rows(array('str_value' => $keyword))->where('cid = ?', $cid)->where('name = ?','keyword'));    
    $db->query($db->update('table.fields')->rows(array('str_value' => $desc))->where('cid = ?', $cid)->where('name = ?','description'));
}

// 分类属性设置
function arcSet($mid,$arc_name,$cover_url,$arc_icon,$arc_desc) {
    $options = Typecho_Widget::widget('Widget_Options');
    $default_cover = $options->coverimg;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    // ALTER TABLE `typecho_metas` DROP COLUMN `cover`;
    if (!array_key_exists('cover', $db->fetchRow($db->select()->from('table.metas')))) {
        $db->query('ALTER TABLE `' . $prefix . 'metas` ADD `cover` varchar(200) NOT NULL DEFAULT "'.$default_cover.'";');
    }
    if (!array_key_exists('icon', $db->fetchRow($db->select()->from('table.metas')))) {
        $db->query('ALTER TABLE `' . $prefix . 'metas` ADD `icon` varchar(200) NOT NULL DEFAULT "";');
    }
    $db->query($db->update('table.metas')->rows(array('name' => $arc_name))->where('mid = ?', $mid));
    $db->query($db->update('table.metas')->rows(array('cover' => $cover_url))->where('mid = ?', $mid));
    $db->query($db->update('table.metas')->rows(array('icon' => $arc_icon))->where('mid = ?', $mid));
    $db->query($db->update('table.metas')->rows(array('description' => $arc_desc))->where('mid = ?', $mid));
}

// 页面设置
function PageSet($cid,$cover_url,$icon) {
    $db = Typecho_Db::get();
    $db->query($db->update('table.fields')
        ->rows(array('str_value' => $cover_url))
        ->where('name = ?', 'cover')
        ->where('cid = ?', $cid));
    $db->query($db->update('table.fields')
        ->rows(array('str_value' => $icon))
        ->where('name = ?', 'icon')
        ->where('cid = ?', $cid));
}

function getTables(){
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $tableArr = array();
    $tables = $db->query("show tables")->fetchAll();
    foreach($tables as $table){
        array_push($tableArr,$table['Tables_in_'.$db->getConfig()[0]->database]);
    }
    return $tableArr;
}
// 链接设置
function addLink($name,$url,$avatar,$desc) {
    $db = Typecho_Db::get();
    if ( in_array("typecho_links", getTables()) ) {
        $insert = $db->insert('table.links')
        ->rows(array('created' => time(),'name' => $name, 'url' => $url, 'avatar' => $avatar, 'desc' => $desc));
        $insertId = $db->query($insert);
    }
}
// 链接输出
function echoLinks(){
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if ( !in_array("typecho_links", getTables()) ) {
        $type = explode('_', $db->getAdapterName());
        $type = array_pop($type);
        $script = 'CREATE TABLE `'. $prefix .'links` (
          `lid` int(10) NOT NULL AUTO_INCREMENT,
          `created` int(10) default "0" ,
          `name` varchar(20) default "",
          `url` varchar(200) default "",
          `avatar` varchar(200) default "",
          `desc` varchar(200) default "",
          PRIMARY KEY  (`lid`)
        ) ';
        $db->query($script, Typecho_Db::WRITE);
        if ( in_array("typecho_links", getTables()) ) {
        $insert = $db->insert('table.links')
        ->rows(array('created' => time(),'name' => '南玖', 'url' => 'https://ztongyang.cn/', 'avatar' => 'https://metu.ztongyang.cn/img/qq2251513837.jpg', 'desc' => '生命不息，折腾不止，就是喜欢花里胡哨'));
        $insertId = $db->query($insert);
        }
    } 
    
    $query= $db->select()->from('table.links')->order('lid',Typecho_Db::SORT_ASC);
    $links = $db->fetchAll($query);
    return $links;
}

// 链接删除
function delLink($lid){
    $db = Typecho_Db::get();
    $query= $db->delete('table.links')->where('lid = ?', $lid);
    $db->query($query);
}

// 链接更新
function updateLink($lid,$name,$url,$avatar,$desc) {
    $db = Typecho_Db::get();
    $db->query($db->update('table.links')->rows(array('name' => $name))->where('lid = ?', $lid));
    $db->query($db->update('table.links')->rows(array('url' => $url))->where('lid = ?', $lid));
    $db->query($db->update('table.links')->rows(array('avatar' => $avatar))->where('lid = ?', $lid));
    $db->query($db->update('table.links')->rows(array('desc' => $desc))->where('lid = ?', $lid));
}


// 说说输出
function echoTalks(){
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if ( !in_array("typecho_talks", getTables()) ) {
        $type = explode('_', $db->getAdapterName());
        $type = array_pop($type);
        $script = 'CREATE TABLE `'. $prefix .'talks` (
          `tid` int(10) NOT NULL AUTO_INCREMENT,
          `created` int(10) default "0" ,
          `type` varchar(20) default "",
          `image` varchar(200) default "",
          `video` varchar(200) default "",
          `text` text,
          PRIMARY KEY  (`tid`)
        ) ';
        $db->query($script, Typecho_Db::WRITE);
        if ( in_array("typecho_talks", getTables()) ) {
        $insert = $db->insert('table.talks')
        ->rows(array('created' => time(),'type' => 'text','image' => '','video' => '', 'text' => '生命不息，折腾不止，就是喜欢花里胡哨'));
        $insertId = $db->query($insert);
        }
    } 
    $query= $db->select()->from('table.talks')->order('tid',Typecho_Db::SORT_DESC);
    $talks = $db->fetchAll($query);
    return $talks;
}
function addTalk($type,$url,$text) {
    $db = Typecho_Db::get();
    if ( in_array("typecho_talks", getTables()) ) {
        if($type !== 'text'){
            $insert = $db->insert('table.talks')
            ->rows(array('created' => time(),'type' => $type, $type => $url, 'text' => $text));
            $db->query($insert);            
        }else{
            $insert = $db->insert('table.talks')
            ->rows(array('created' => time(),'type' => $type, 'text' => $text));
            $db->query($insert);            
        }
    }
}
function delTalk($tid){
    $db = Typecho_Db::get();
    $query= $db->delete('table.talks')->where('tid = ?', $tid);
    $db->query($query);
}
function updateTalk($tid,$type,$url,$text) {
    $db = Typecho_Db::get();
    $db->query($db->update('table.talks')->rows(array('type' => $type))->where('tid = ?', $tid));
    $db->query($db->update('table.talks')->rows(array($type => $url))->where('tid = ?', $tid));
    $db->query($db->update('table.talks')->rows(array('text' => $text))->where('tid = ?', $tid));
}
//文章解析
function parsePaopaoBiaoqingCallback($match){
    return '<img class="biaoqing" src="/usr/themes/Grace/assets/OwO/owo/paopao/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
}
function parseAruBiaoqingCallback($match){
    return '<img class="biaoqing" src="/usr/themes/Grace/assets/OwO/owo/aru/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
}
function parseDloadcardCallback($match){
    return '<div class="dload-card shadow"><div class="dload-img"><svg t="1606703929418" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="15032" width="200" height="200"><path d="M0 139.9c0-53.1 37.3-91.1 89.6-91.1h283.7c52.3 0 89.6 38 89.6 91.1v22.8c0 22.8 22.4 45.5 44.8 45.5h321c52.2 0 89.6 38 89.6 91.1V322H253.8c-44.8 0-97 38-104.6 91.1l-97 546.4c-29.8 0-52.2-38-52.2-91.1V139.9z m0 0" fill="var(--theme-bg-color1)" p-id="15033"></path><path d="M201.6 435.9c7.4-38 44.8-68.3 82.1-68.3h686.8c37.3 0 59.8 30.3 52.2 68.3l-89.6 455.3c0 38-37.3 68.3-74.6 68.3H97l104.6-523.6z m0 0" fill="var(--theme-bg-color3)" p-id="15034"></path></svg></div><div class="list-inline"><div class="file-title">'.$match[1].'</div><div class="file-introduce h-2x">'.$match[3].'</div></div><div class="dload-tag hint--top hint--rounded" aria-label="点击下载"><button class="dload-btn" url="'.$match[2].'" filename="'.$match[1].'.'.explode(".",$match[2])[count(explode(".",$match[2]))-1].'" filetype="'.explode(".",$match[2])[count(explode(".",$match[2]))-1].'"><i class="fa fa-download" aria-hidden="true"></i></button></div></div>';
}
function parseVideoCallback($match){
    $options = Typecho_Widget::widget('Widget_Options');
    return '<div id="" class="post-video" data-url="'.$match[1].'"  data-cover="'.$match[2].'" data-logo="'.$options->vlogo.'"></div>';
}

function parseBiaoQing($content){
    $content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
'parsePaopaoBiaoqingCallback', $content);
    $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
'parseAruBiaoqingCallback', $content);
    return $content;
}
function Parsepost($content){
    $content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
'parsePaopaoBiaoqingCallback', $content);
    $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
'parseAruBiaoqingCallback', $content);

    $content = preg_replace_callback('#\[dload\s+name="(.*?)"\s+link="(\S+)"\s+introduce="(.*?)"\s+/]#',
'parseDloadcardCallback', $content);
    
    $content = preg_replace_callback('#\[video\s+url="(.*?)"\s+cover="(.*?)"\s+\/]#',
'parseVideoCallback', $content);
    return $content;
}

// 头像
function comavatar($mail,$id=0){
	$a=Typecho_Widget::widget('Widget_Options')->gravatars;
	$b='https://gravatar.loli.net/avatar'.$a.'/';
	$c=strtolower($mail);
	$d=md5($c);
	$f=str_replace('@qq.com','',$c);
	if(strstr($c,"qq.com")&&is_numeric($f)&&strlen($f)<11&&strlen($f)>4){
		$g='//q.qlogo.cn/g?b=qq&nk='.$f.'&s=100';
	}else{
		$g=$b.$d.'?d=mm';
        // $g=getrdqq(10);
	}
	echo $g;
}
function get_comment_at($coid){
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')->where('coid = ?', $coid));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                                     ->where('coid = ? AND status = ?', $parent, 'approved'));
if($arow['author']){ $author = $arow['author'];
        $href   = '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        echo $href;
}else { echo '';}
    } else {
        echo '';
    }
}


Typecho_Plugin::factory('admin/write-post.php')->bottom = array('OwO', 'edit');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('OwO', 'edit');
class OwO {
    public static function edit()
    {
        $options = Typecho_Widget::widget('Widget_Options');

    ?>
    <script src="<?php $options->themeUrl('assets/OwO/OwO.min.js'); ?>"></script>
    <script src="<?php $options->themeUrl('assets/js/edit.js'); ?>"></script>
<?php
    }
}


function Weekday(){
    $weekarray=array("日","一","二","三","四","五","六");
    echo "星期".$weekarray[date("w")];
}

function GrabImage($url) {
    $folder = dirname(__FILE__).'/poster/';
    is_dir($folder) OR mkdir($folder, 0777, true);
    $filetype = explode(".",$url)[count(explode(".",$url))-1];
    $filename = 'poster.'.$filetype;
    $file= dirname(__FILE__).'/poster/'.$filename;
    if(file_exists($file)){
        unlink($file);
    }
    ob_start();
    readfile($url);
    $img = ob_get_contents();
    ob_end_clean();
    $fp2=@fopen(dirname(__FILE__).'/poster/'.$filename, "a");
    fwrite($fp2,$img);
    fclose($fp2);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
    for ($i = 0; $i < 10; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
    return '/usr/themes/Grace/poster/'.$filename.'?'.$randomString;
    }
function AvaImage($url) {
    $filetype = explode(".",$url)[count(explode(".",$url))-1];
    $filename = 'avatar.'.$filetype;
    $file= dirname(__FILE__).'/poster/'.$filename;
    if(file_exists($file)){
        unlink($file);
    }
    ob_start();
    readfile($url);
    $img = ob_get_contents();
    ob_end_clean();
    $fp2=@fopen(dirname(__FILE__).'/poster/'.$filename, "a");
    fwrite($fp2,$img);
    fclose($fp2);
    return '/usr/themes/Grace/poster/'.$filename;
    }


// 文章目录
function createCatalog($obj) {    //为文章标题添加锚点
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count ++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        return '<h'.$obj[1].$obj[2].'><a class="topmao" name="cl-'.$catalog_count.'"></a>'.$obj[3].'</h'.$obj[1].'>';
    }, $obj);
    return $obj;
}

//输出文章目录容器
function getCatalog() {    
    global $catalog;
    if ($catalog) {
        $index = '<ul id="toc-container">';
        foreach($catalog as $catalog_item) {
            $count = $catalog_item['count'];
            $toc = $catalog_item['text'];
            $depth = $catalog_item['depth'];
            $index .= '<li class="toc-ctrl toc-s'.$depth.'"><a class="wh-100 toc-'.$depth.'" href="#cl-'.$count.'">'.$toc.'</a></li>';
        }
        $index .= '</ul>';
    echo $index;  
    }
}

function themeInit($archive) {
    if ($archive->is('single')) {
        $archive->content = createCatalog($archive->content);
    }
}

// 下一篇
function GtheNext($widget)
{
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created > ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_ASC)
        ->limit(1);
    $content = $db->fetchRow($sql);
    if ($content) {
        $content = $widget->filter($content);
    }
    return $content;
}

// 上一篇
function GthePrev($widget, $word = '上一篇', $default = NULL)
{
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created < ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1);
        $content = $db->fetchRow($sql);
        if ($content) {
            $content = $widget->filter($content);
        }
        return $content;
}

function QmsgTUSend($TUtitle,$TUsum,$TUlink){
    $options = Helper::options();
    // $options = Typecho_Widget::widget('Widget_Options');
    $msg = '有人给你点赞啦👍👍👍 ' . PHP_EOL . PHP_EOL
        . '点赞文章：《' . $TUtitle . '》' . PHP_EOL
        . '获赞总数：' . strval(intval($TUsum) + 1) . PHP_EOL
        . '文章链接：' . $TUlink;
    $api = "https://qmsg.zendee.cn/send/";
    $params = [
        'qq'    => $options->Qmsg_qq,
        'msg'   => $msg
    ];
    $context = stream_context_create([
        'http' => [
            'method'    => 'POST',
            'header'    => 'Content-type: application/x-www-form-urlencoded',
            'content'   => http_build_query($params)
        ]
    ]);
    $result = file_get_contents($api.$options->Qmsg_key, false, $context);
    // print_r($result);
}

