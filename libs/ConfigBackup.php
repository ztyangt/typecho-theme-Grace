<?php

$notice = Typecho_Widget::widget('Widget_Notice');
$str1 = explode('/themes/', Helper::options()->themeUrl);
$str2 = explode('/', $str1[1]);
$name=$str2[0];
$db = Typecho_Db::get();
$backup_data=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name))['value'];

if(isset($_POST['type'])){ 
    if($_POST["type"]=="备份数据"){
        if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'backup'))){
            $update = $db->update('table.options')->rows(array('value'=>$backup_data))->where('name = ?', 'theme:'.$name.'backup');
            $updateRows= $db->query($update);
        }else{
            if($backup_data){
                $insert = $db->insert('table.options')
                ->rows(array('name' => 'theme:'.$name.'backup','user' => '0','value' => $backup_data));
                $insertId = $db->query($insert);
            }
        }   
    }
    if($_POST["type"]=="还原数据"){
        if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'backup'))){
            $dataarr=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'backup'));
            $data = $dataarr['value'];
            $update = $db->update('table.options')->rows(array('value'=>$data))->where('name = ?', 'theme:'.$name);
            $updateRows= $db->query($update);
        }
    }
    if($_POST["type"]=="删除备份"){
        if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'backup'))){
            $delete = $db->delete('table.options')->where ('name = ?', 'theme:'.$name.'backup');
            $deletedRows = $db->query($delete);
        }
    }
}

//备份数据提示
if ($_POST["type"] == "备份数据") {
    if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'backup'))) {
        $notice->set(_t("备份已更新，请等待自动刷新！"), 'success');
?>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 1000);</script>
<?php
} else {
    $notice->set(_t("备份已完成，请等待自动刷新！"), 'success');
?><script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 1000);</script>
<?php
    }
}
//还原数据提示
if ($_POST["type"] == "还原数据") {
    if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'backup'))) {
        $notice->set(_t("检测到主题备份数据，恢复完成，请等待自动刷新！"), 'success');
?>
<a  href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 1000);</script>
<?php
} else {
    $notice->set(_t("没有主题备份数据，恢复不了哦"), 'error');
    }
?>
<?php
}
            

//删除数据提示
if ($_POST["type"] == "删除备份") {
    if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'backup'))) {
        $notice->set(_t("删除成功，请等待自动刷新！"), 'success');
?>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 1000);</script>
<?php
} else {
    $notice->set(_t("不用删了！备份不存在！！！"), 'error');
?>
</script>
<?php
    }
}
echo '<br>';
