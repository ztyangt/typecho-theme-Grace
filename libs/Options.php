<?php
/**
 * 主题后台设置
 */
 
require_once("Grace.php");

 
function themeConfig($form) {
	echo Grace::Style();
	require_once("ConfigBackup.php"); // 模板设置数据备份
	echo Grace::Option_nav();
	$themeUrl = Grace::Theme_url();
	$options = Helper::options();
	

	//个人信息
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane0">'));
		$sidebg = new Typecho_Widget_Helper_Form_Element_Text('sidebg', NULL, $options->themeUrl("/img/default-bg.jpg","Grace"), _t('个人形象照片'), _t(''));
		$form->addInput($sidebg);

		$job = new Typecho_Widget_Helper_Form_Element_Text('job', NULL, NULL, _t('工作'), _t(''));
		$form->addInput($job);

		$addr = new Typecho_Widget_Helper_Form_Element_Text('addr', NULL, NULL, _t('地址'), _t(''));
		$form->addInput($addr);

		
		$QQ = new Typecho_Widget_Helper_Form_Element_Text('QQ', NULL, NULL, _t('QQ号'), _t('个人信息展示'));
	    $form->addInput($QQ);

    	$wechat = new Typecho_Widget_Helper_Form_Element_Text('wechat', NULL, NULL, _t('微信号'), _t('个人信息展示'));
		$form->addInput($wechat);

    	$email = new Typecho_Widget_Helper_Form_Element_Text('email', NULL, NULL, _t('联系邮箱'), _t('个人信息展示'));
		$form->addInput($email);

    	$github = new Typecho_Widget_Helper_Form_Element_Text('github', NULL, NULL, _t('github主页'), _t('个人信息展示'));
		$form->addInput($github);

	$form->addItem(new FormLabel('</div>'));


	// 图片设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane1">'));
    	$favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, $options->themeUrl("/img/favicon.svg","Grace"), _t('站点favicon.ico图标地址'), _t(''));
    	$form->addInput($favicon);

	    $logo = new Typecho_Widget_Helper_Form_Element_Text('logo', NULL, NULL, _t('网站logo地址'), _t('')); 
		$form->addInput($logo);
		
	
    	$avatar = new Typecho_Widget_Helper_Form_Element_Text('avatar', NULL, $options->themeUrl("/img/no-avatar.png","Grace"), _t('用户头像'), _t(''));
    	$form->addInput($avatar);
    	
    	$coverimg = new Typecho_Widget_Helper_Form_Element_Text('coverimg', NULL, $options->themeUrl("/img/default-bg.jpg","Grace"), _t('网站默认配图'), _t(''));	
    	$form->addInput($coverimg);
		
		$lazyimg = new Typecho_Widget_Helper_Form_Element_Text('lazyimg', NULL, $options->themeUrl("/img/loading.gif","Grace"), _t('懒加载图片'), _t(''));
		$form->addInput($lazyimg);
		
		$vlogo = new Typecho_Widget_Helper_Form_Element_Text('vlogo', NULL, $options->themeUrl("/img/video-logo.png","Grace"), _t('视频logo'), _t('Dplayer视频播放器logo'));
		$form->addInput($vlogo);

	$form->addItem(new FormLabel('</div>'));
	
	// 首页设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane2">'));
		$banner_ctrl = new Typecho_Widget_Helper_Form_Element_Radio('banner_ctrl', 
	    array('On' => _t('开启'),
	    'Off' => _t('关闭')),'Off' 
	    ,_t('是否显示首页文章轮播'),_t('默认关闭，勾选表示开启,不开启则显示默认封面!'));
		$form->addInput($banner_ctrl);
	
		$duanju = new Typecho_Widget_Helper_Form_Element_Radio('duanju', 
	    array('On' => _t('开启'),
	    'Off' => _t('关闭')),'Off' 
	    ,_t('是否开启轮播随机短句'),_t('默认关闭，勾选表示开启,不开启则显示站点副标题!'));
	    $form->addInput($duanju);

		$index_layout = new Typecho_Widget_Helper_Form_Element_Radio('index_layout', array(
			'layout1'=>_t('<div class="lunbo"><img class="layout-box" src="'.$options->themeUrl("/img/lunbo1.png","Grace").'"></img><div>左右结构</div></div>'),
			'layout2'=>_t('<div class="lunbo"><img class="layout-box" src="'.$options->themeUrl("/img/lunbo2.png","Grace").'"></img><div>上下结构</div></div>'),
		), 
			"layout1", _t('首页轮播图位置'), _t(''));
		$form->addInput($index_layout);

		$post_style = new Typecho_Widget_Helper_Form_Element_Radio('post_style', array(
			'list1'=>_t('<div class="lunbo"><img class="layout-box" src="'.$options->themeUrl("/img/list1.png","Grace").'"></img></div>'),
			'list2'=>_t('<div class="lunbo"><img class="layout-box" src="'.$options->themeUrl("/img/list2.png","Grace").'"></img></div>'),
		), 
			"list1", _t('首页文章列表样式'), _t(''));
		$form->addInput($post_style);

		$tagpage = new Typecho_Widget_Helper_Form_Element_Radio('tagpage', array(
			'page1'=>_t('极简模式'),
			'page2'=>_t('图文模式'),
		), 
			"page1", _t('首页标签页模式'), _t(''));
		$form->addInput($tagpage);

	$form->addItem(new FormLabel('</div>'));

	// 文章设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane3">'));
		$reward = new Typecho_Widget_Helper_Form_Element_Radio('reward', 
		    array('On' => _t('开启'),
		    'Off' => _t('关闭')),'Off' 
		    ,_t('是否开启打赏功能'),_t('默认关闭'));
		$form->addInput($reward);
	
		$thumbUp = new Typecho_Widget_Helper_Form_Element_Radio('thumbUp', 
		    array('On' => _t('开启'),
		    'Off' => _t('关闭')),'Off' 
		    ,_t('是否开启点赞功能'),_t('默认关闭'));
		$form->addInput($thumbUp);

		$poster = new Typecho_Widget_Helper_Form_Element_Radio('poster', 
		    array('On' => _t('开启'),
		    'Off' => _t('关闭')),'Off' 
		    ,_t('是否开启海报分享'),_t('需对主题目录下的poster文件夹开启读取权限'));
		$form->addInput($poster);

		$fileType = new Typecho_Widget_Helper_Form_Element_Text('fileType', NULL, 'png, jpg, jpeg, bmp, gif,svg,mp4,mp3,flv,txt,doc,docx,xls,ppt', _t('文章下载卡片支持的文件类型'), _t('用英文逗号隔开，只有以上列表有的文件类型才能正常使用下载卡片功能'));
	    $form->addInput($fileType);

		$HLstyle = new Typecho_Widget_Helper_Form_Element_Select('HLstyle', 
		    array(
			'default' => _t('default'),
			'coy' => _t('coy'),
			'dark' => _t('dark'),
		    'okaikia' => _t('okaikia'),
		    'tomorrow-night' => _t('tomorrow-night'),
		    'twilight' => _t('twilight'),
		    ),'default' 
		    ,_t('选择代码高亮主题'),_t('代码高亮样式'));
	    $form->addInput($HLstyle);

		$form->addItem(new FormLabel('<div class="tab-option"><h2 class="tab-title">打赏二维码配置</h2>'));
		$Alipay = new Typecho_Widget_Helper_Form_Element_Text('Alipay', NULL, $options->themeUrl("/img/Alipay.png","Grace"), _t('支付宝打赏二维码'), _t(''));
	    $form->addInput($Alipay);

    	$WCpay = new Typecho_Widget_Helper_Form_Element_Text('WCpay', NULL, $options->themeUrl("/img/WCpay.png","Grace"), _t('微信打赏二维码'), _t(''));
	    $form->addInput($WCpay);
	    $form->addItem(new FormLabel('</div>'));
	$form->addItem(new FormLabel('</div>'));

	// 侧栏设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane4">'));
		$sider_layout = new Typecho_Widget_Helper_Form_Element_Radio('sider_layout', array(
			'layout1'=>_t('<div class="lunbo"><img class="layout-box" src="'.$options->themeUrl("/img/sidebar1.png","Grace").'"></img><div>侧栏在右</div></div>'),
			'layout2'=>_t('<div class="lunbo"><img class="layout-box" src="'.$options->themeUrl("/img/sidebar2.png","Grace").'"></img><div>侧栏在左</div></div>'),
		), 
			"layout1", _t('侧栏位置'), _t(''));
		$form->addInput($sider_layout);

		$sideWidget = new Typecho_Widget_Helper_Form_Element_Checkbox('sideWidget', 
	    array(
			'user-widget' => _t('个人信息模块'),
			'nav-links' => _t('导航链接模块'),
			'web-widget' => _t('网站详情模块'),
			'new-comt' => _t('近期评论模块'),
			'new-update' => _t('最近更新模块'),
			'tags-cloud' => _t('标签云模块'),
			),
	    array('user-widget','tags-cloud'), _t('侧栏显示模块'), _t(''));
	    $form->addInput($sideWidget->multiMode());

		$navname = new Typecho_Widget_Helper_Form_Element_Text('navname', NULL,"旗下站点", _t('导航模块名字'), _t(''));
		$form->addInput($navname);	    

		$navLinks = new Typecho_Widget_Helper_Form_Element_Textarea('navLinks', NULL, "南玖博客 $ https://ztongyang.cn $ https://metu.ztongyang.cn/img/icon2021.png $ 网站说明
南玖博客 $ https://ztongyang.cn $ https://metu.ztongyang.cn/img/icon2021.png $ 网站说明", 
		_t('导航模块链接'), _t('格式：名称 $ url $ 链接图标 $ 链接说明，一行一个'));
	    $form->addInput($navLinks);

	$form->addItem(new FormLabel('</div>'));

	// 页脚设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane5">'));
		$beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, "网站备案号", _t('天朝ICP通行证'), _t('网站备案号，在页脚展示'));
		$form->addInput($beian);

		$footerLinks = new Typecho_Widget_Helper_Form_Element_Textarea('footerLinks', NULL, "友链申请 $ https://ztongyang.cn
免责声明 $ https://ztongyang.cn
关于我们 $ https://ztongyang.cn", 
		_t('页脚链接'), _t('格式：名称$url<br>一行一个,推荐三个，过多可能会影响布局美观'));
	    $form->addInput($footerLinks);

		$typed_text = new Typecho_Widget_Helper_Form_Element_Textarea('typed_text', NULL, 'Never really desperate, only the lost of the soul', _t('打字机内容'), _t('回车分隔，一行一句'));
    	$form->addInput($typed_text);

	$form->addItem(new FormLabel('</div>'));

	// 全局设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane6">'));
	$night = new Typecho_Widget_Helper_Form_Element_Radio('night', 
	    array('On' => _t('开启'),
	    'Off' => _t('关闭')),'On' 
	    ,_t('是否自动切换夜间模式 '),_t('默认开启，早晚八点自动切换夜间模式，开启自动切换夜间模式后，手动调节夜间模式的有效时间为6小时'));
	    $form->addInput($night);

    	$settime = new Typecho_Widget_Helper_Form_Element_Text('settime', NULL, date("Y-m-d H:i:s",time()), _t('建站时间'), _t('用于统计网站运行时间，格式：2019-07-25 22:13:04'));
    	$form->addInput($settime);
		
		$loadingStyle = new Typecho_Widget_Helper_Form_Element_Select('loadingStyle',array(
			'loading-1'=>'动画1',
			'loading-2'=>'动画2',
			'loading-3'=>'动画3',
			'loading-4'=>'动画4',
			'loading-5'=>'动画5',
			'loading-6'=>'动画6'),
			'loading-1','全局加载动画风格');
    	$form->addInput($loadingStyle);	
	$form->addItem(new FormLabel('</div>'));

	// 提醒设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane7">'));

		$QmsgTU = new Typecho_Widget_Helper_Form_Element_Radio('QmsgTU', 
	    array('On' => _t('开启'),
	    'Off' => _t('关闭')),'Off' 
	    ,_t('Qmsg酱点赞QQ提醒'),_t('登录<a style="color:#2997f7;" href="https://qmsg.zendee.cn/api.html">Qmsg酱</a>申请Qmsg酱key，并正确填写下方配置信息'));
	    $form->addInput($QmsgTU);

		$notice = new Typecho_Widget_Helper_Form_Element_Checkbox('notice', 
	    array(
			'QmsgPush' => _t('Qmsg酱'),
			'StmpPush' => _t('SMTP邮件'),
			),
	    array('user-widget','tags-cloud'), _t('评论提醒方式'), _t('需要正确填写下方各项相关配置'));
	    $form->addInput($notice->multiMode());

	    $form->addItem(new FormLabel('<div class="tab-option"><h2 class="tab-title">Qmsg配置</h2>'));
		$Qmsg_key = new Typecho_Widget_Helper_Form_Element_Text('Qmsg_key', NULL, NULL, _t('Qmsg酱key'), _t('登录<a style="color:#2997f7;" href="https://qmsg.zendee.cn/api.html">Qmsg酱</a>申请Qmsg酱key'));
		$form->addInput($Qmsg_key);	

		$Qmsg_qq = new Typecho_Widget_Helper_Form_Element_Text('Qmsg_qq', NULL, NULL, _t('Qmsg接受消息的QQ号'), _t('多个QQ号以英文逗号分割（指定的QQ必须在您的QQ号列表中，最多支持5个)'));
		$form->addInput($Qmsg_qq);	
		$form->addItem(new FormLabel('</div>'));

		$form->addItem(new FormLabel('<div class="tab-option"><h2 class="tab-title">STMP邮件配置</h2>'));
		$smtp_name = new Typecho_Widget_Helper_Form_Element_Text('smtp_name', NULL, NULL, _t('发件人名称'), _t('邮件中显示的发信人名称，留空为博客名称'));
        $form->addInput($smtp_name);
        $smtp_mail = new Typecho_Widget_Helper_Form_Element_Text('smtp_mail', NULL, NULL, _t('发件邮箱地址'), _t('邮件中显示的发信地址'));
        $form->addInput($smtp_mail->addRule('email', _t('请输入正确的邮箱地址')));
        $smtp_replyto = new Typecho_Widget_Helper_Form_Element_Text('smtp_replyto', NULL, NULL, _t('邮件回复地址'), _t('附带在邮件中的默认回信地址'));
        $form->addInput($smtp_replyto->addRule('email', _t('请输入正确的邮箱地址')));
        $smtp_host = new Typecho_Widget_Helper_Form_Element_Text('smtp_host', NULL, NULL, _t('SMTP地址'), _t('SMTP 服务器地址'));
        $form->addInput($smtp_host);
        $smtp_port = new Typecho_Widget_Helper_Form_Element_Text('smtp_port', NULL, NULL, _t('SMTP端口'), _t('SMTP 服务器连接端口，一般为 25'));
        $form->addInput($smtp_port);
        $smtp_user = new Typecho_Widget_Helper_Form_Element_Text('smtp_user', NULL, NULL, _t('SMTP登录用户'), _t('SMTP 登录用户名，一般为邮箱地址'));
        $form->addInput($smtp_user);
        $smtp_pass = new Typecho_Widget_Helper_Form_Element_Text('smtp_pass', NULL, NULL, _t('SMTP登录密码'), _t('一般为邮箱密码，但某些服务商需要生成特定密码'));
        $form->addInput($smtp_pass);
        $smtp_auth = new Typecho_Widget_Helper_Form_Element_Checkbox('smtp_auth', array('enable' => _t('服务器需要验证')), 'enable', _t('SMTP验证模式'));
        $form->addInput($smtp_auth);
        $smtp_secure = new Typecho_Widget_Helper_Form_Element_Radio('smtp_secure', array('none' => _t('无加密'), 'ssl' => _t('SSL 加密'), 'tls' => _t('TLS 加密')), 'none', _t('SMTP加密模式'));
        $form->addInput($smtp_secure);
        $form->addItem(new FormLabel('</div>'));


	$form->addItem(new FormLabel('</div>'));

	// 其他设置
	$form->addItem(new FormLabel('<div class="tab-pane" id="pane8">'));
		$tongji = new Typecho_Widget_Helper_Form_Element_Textarea('tongji', NULL, NULL, _t('统计代码'), _t('插入在head部分的代码'));
	    $form->addInput($tongji);

		$diycss = new Typecho_Widget_Helper_Form_Element_Textarea('diycss', NULL, NULL, _t('自定义css'), _t(''));
	    $form->addInput($diycss);

		$diyjs = new Typecho_Widget_Helper_Form_Element_Textarea('diyjs', NULL, NULL, _t('自定义js'), _t(''));
	    $form->addInput($diyjs);	    
	    
	$form->addItem(new FormLabel('</div>'));
	    
	$form->addItem(new FormLabel('</div></div></div></div></div>'));
	$form->addItem(new FormLabel('<script src="'.$themeUrl.'assets/js/back.js"></script>'));
}

// 自定义关键字
if($_SERVER['SCRIPT_NAME']=="/admin/write-post.php"){
	function themeFields($layout) {
		$indent = new Typecho_Widget_Helper_Form_Element_Radio('indent', 
		array('Yes' => _t('是'),
		'No' => _t('否')),'No' 
		,_t('首行缩进'),_t('开启后文章段首自动缩进2字符'));
		$layout->addItem($indent);

		$slide = new Typecho_Widget_Helper_Form_Element_Radio('slide', 
		array('Yes' => _t('是'),
		'No' => _t('否')),'No' 
		,_t('首页轮播'),_t('开启后该文章将加入首页轮播'));
		$layout->addItem($slide);
		
		$topPost = new Typecho_Widget_Helper_Form_Element_Radio('topPost', 
		array('Yes' => _t('是'),
		'No' => _t('否')),'No' 
		,_t('置顶文章'),_t(''));
		$layout->addItem($topPost);

		$cover = new Typecho_Widget_Helper_Form_Element_Text('cover', NULL, NULL, _t('文章封面'), _t('请填入封面图片地址,不输入则随机使用默认封面'));
		$cover->input->setAttribute('class', 'w-100');
		$layout->addItem($cover);
		
		$keyword = new Typecho_Widget_Helper_Form_Element_Text('keyword', NULL, NULL, _t('关键词'), _t('多个关键词请用英文逗号隔开'));
		$keyword->input->setAttribute('class', 'w-100');
		$layout->addItem($keyword);  
		
		$description = new Typecho_Widget_Helper_Form_Element_Textarea('description', NULL, NULL, _t('文章描述'), _t('请输入文章描述'));
		$description->input->setAttribute('style', 'width:100%;height:120px;');
		$layout->addItem($description); 
	}


	}	

	if($_SERVER['SCRIPT_NAME']=="/admin/write-page.php"){
		function themeFields($layout) {
			$cover = new Typecho_Widget_Helper_Form_Element_Text('cover', NULL, NULL, _t('封面'), _t('请填入封面图片地址,不输入则随机使用默认封面'));
			$cover->input->setAttribute('class', 'w-100');
			$layout->addItem($cover);
			
			$icon = new Typecho_Widget_Helper_Form_Element_Text('icon', NULL, NULL, _t('页面图标'), _t(''));
			$icon->input->setAttribute('class', 'w-100');
			$layout->addItem($icon);  
		}
	}	
