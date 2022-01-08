<?php

$admin = get_object_vars($this->user)['row']['group']; 

if($this->is('post')){
	if (isset($_POST['ThumbUp'])) {
	    if ($_POST['ThumbUp'] == $this->cid){
	        ThumbUp($this->cid);
	        if($this->options->QmsgTU == "On"){
	        	exit(QmsgTUSend($_POST['TUtitle'],$_POST['TUsum'],$_POST['TUlink']));
	        }
	        }
	    exit('error');
 	}
 	if(isset($_POST['postCid'])){
 		if($_POST['postCid'] == $this->cid){
 			exit(Postset($_POST['postCid'],$_POST['indent'],$_POST['slide'],$_POST['topPost'],$_POST['postName'],$_POST['postCover'],$_POST['postKeywords'],$_POST['postDesc']));
 		}
 		exit('error');
 	}
}
 
if ($admin == "administrator" && $this->is('archive')){
	if (isset($_POST['arcId'])) {
		if ($_POST['arcId'] == $this->getPageRow()['mid']){
			exit(arcSet($this->getPageRow()['mid'],$_POST['name'],$_POST['cover'],$_POST['icon'],$_POST['desc']));
		}
		exit('error');
	}
}

if ($admin == "administrator" && $this->is('page')){
	 if (isset($_POST['pageCid'])) {
	 	if ($_POST['pageCid'] == $this->cid){
	 		exit(PageSet($this->cid,$_POST['pageCover'],$_POST['pageIcon']));
	 	}
	 	exit('error');
	 } 
	}

if ($admin == "administrator" && ($this->template == 'links.php')){ 
	if (isset($_POST['ajaxPage'])) {
		if ($_POST['ajaxPage'] == 'links'){
			exit(addLink($_POST['linksName'],$_POST['linksUrl'],$_POST['linksAvatar'],$_POST['linksDesc']));
		}exit('error');
	} 
	if (isset($_POST['DelLid'])) {
		exit(delLink($_POST['DelLid']));
		exit('error');
	} 
	if (isset($_POST['editLid'])) {
		exit(updateLink($_POST['editLid'],$_POST['editName'],$_POST['editUrl'],$_POST['editAvatar'],$_POST['editDesc']));
		exit('error');
	} 
}

if ($admin == "administrator" && ($this->template == 'talks.php')){
	if (isset($_POST['talk-type'])) {
		addTalk($_POST['talk-type'],$_POST['talk-mata'],$_POST['talk-text']);
		exit(header("location:". $this->permalink));
		exit('error');
	} 
	if (isset($_POST['DelTid'])) {
		exit(delTalk($_POST['DelTid']));
		exit('error');
	} 
	if (isset($_POST['talk-type1'])) {
		updateTalk($_POST['talk-tid'],$_POST['talk-type1'],$_POST['talk-mata1'],$_POST['talk-text1']);
		exit(header("location:". $this->permalink));
		exit('error');
	} 
}

if ($admin == "administrator"){
	if (isset($_POST['themeColor'])) {
		exit(themeColor(rgb2hex($_POST['themeColor'])));
		exit('error');
	} 
}

if (isset($_POST['QQ_push'])) {
	exit(QmsgComentSend($_POST['Qtitle'],$_POST['Quser'],$_POST['Qemail'],$_POST['Qlink'],$_POST['Qmsg']));
	exit('error');
} 

// if (isset($_POST['gt'])) {
//         $api = "https://qmsg.zendee.cn/send/";
//         $params = [
//             'qq' => "2251513837",
//             'msg' => $_POST['html']
//         ];
//         $context = stream_context_create([
//             'http' => [
//                 'method' => 'POST',
//                 'header' => 'Content-type: application/x-www-form-urlencoded',
//                 'content' => http_build_query($params)
//             ]
//         ]);
//         $result = file_get_contents($api.$this->options->Qmsg_key, false, $context);
// } 




