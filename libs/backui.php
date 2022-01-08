
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="overlay wh-100"></div>
<div class="myui">
	<div class="menu"><svg t="1606811842426" class="icon ycenter" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3704" width="16" height="16"><path d="M892.928 128q28.672 0 48.64 19.968t19.968 48.64l0 52.224q0 28.672-19.968 48.64t-48.64 19.968l-759.808 0q-28.672 0-48.64-19.968t-19.968-48.64l0-52.224q0-28.672 19.968-48.64t48.64-19.968l759.808 0zM892.928 448.512q28.672 0 48.64 19.968t19.968 48.64l0 52.224q0 28.672-19.968 48.64t-48.64 19.968l-759.808 0q-28.672 0-48.64-19.968t-19.968-48.64l0-52.224q0-28.672 19.968-48.64t48.64-19.968l759.808 0zM892.928 769.024q28.672 0 48.64 19.968t19.968 48.64l0 52.224q0 28.672-19.968 48.64t-48.64 19.968l-759.808 0q-28.672 0-48.64-19.968t-19.968-48.64l0-52.224q0-28.672 19.968-48.64t48.64-19.968l759.808 0z" p-id="3705" fill="#fff"></path></svg></div>
	<div class="myui-left scale ycenter">
		<div class="aside">
			<div class="myui-left-top">
				<div id="version" class="title xcenter" data="<?php echo $version ?>">Grace <?php echo $version ?></div>
			</div>	
			<div class="option-tab">
				<ul class="myui-top-nav nav nav-pills">
	            <li class="intitle"><a data-target="#pane0" data-toggle="pill"><span>个人信息</span></a></li>
	            <li class="intitle"><a data-target="#pane1" data-toggle="pill"><span>图片设置</span></a></li>
	            <li class="intitle"><a data-target="#pane2" data-toggle="pill"><span>首页设置</span></a></li>
	            <li class="intitle"><a data-target="#pane3" data-toggle="pill"><span>文章设置</span></a></li>
	            <li class="intitle"><a data-target="#pane4" data-toggle="pill"><span>侧栏设置</span></a></li>
	            <li class="intitle"><a data-target="#pane5" data-toggle="pill"><span>页脚设置</span></a></li>
	            <li class="intitle"><a data-target="#pane6" data-toggle="pill"><span>全局设置</span></a></li>
	            <li class="intitle"><a data-target="#pane7" data-toggle="pill"><span>提醒设置</span></a></li>
	            <li class="intitle"><a data-target="#pane8" data-toggle="pill"><span>其他设置</span></a></li>
	        	</ul>
			</div>	
			<div class="backup"> 
					<form class="backup-data" action="?Gracebackup" method="post">
	                    <input type="submit" name="type" class="card-1 green cursor" value="备份数据" />
	                    <input type="submit" name="type" class="card-1 orange cursor" value="还原数据" />
	                    <input type="submit" name="type" class="card-1 red cursor" value="删除备份" />
	                </form>				
			</div>	
		</div>	
	</div>
	<div class="myui-right">
	    <div class="myui-top-card">
	        <h2 class="myui-top-title">Grace主题设置面板</h2>
	        <div class="myui-top-card-info mu">
	            <span>作者:<a href="https://ztongyang.cn/">南玖</a></span>
	            <span>文档:<a href="#">WIKI</a></span>
	            <span>版本:<?php echo $version ?></span>
	        </div>
	       <div class="myui-top-card-info">生命不息，折腾不止，欢迎使用<span style="color:blue;">Grace</span>主题！</div>
	        <span class="after">GRACE主题</span>
	    </div>
	    <div class="option-pane">
	    <div class="myui-form">
	    <div class="tab-content">