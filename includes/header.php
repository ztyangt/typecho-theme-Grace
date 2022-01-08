<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;$this->need('./action/Action.php');?>
<!DOCTYPE HTML>
<html class="no-js" lang="zh">
<head>
	<?php $this->need('./component/head.php'); ?>
</head>

<body class="nav-fixed <?php Switch_day(); if(strlen($_COOKIE['night']) !== 0){if($_COOKIE["night"]=="1"){echo "dark-theme";}else{echo "white-theme";}}else{if($this->options->night == "On"){if(Switch_day()){echo "dark-theme";}else{echo "white-theme";}}}?>">
<?php $this->need('./component/loading.php'); ?>

<header class="clearfix">
	<div id="header" class="header shadow hcenter" id="head">
		<div class="headnav col-wd-8">
			<div id="mside-btn" class="m-nav-btn cursor"><div class="ycenter"><i class="fa fa-bars" aria-hidden="true"></i></div></div>
			<a class="logo navbar-logo ht-100" href="<?php $this->options->siteUrl(); ?>">
			<div class="navbar-logo">
				<?php if(!empty($this->options->logo)): ?>
					<img class="ht-100" src="<?php $this->options->logo(); ?>"/>
				<?php else: ?>
				<div class="webtitle"><span class="ycenter"><?php $this->options->title(); ?></span></div>
				<?php endif; ?>
			</div>
			</a>
			<nav class="nav wh-100">
		        <ul class="nav_menu">
		            <li class="nav_menu_li ycenter"><a class="nav_menu_lis" href="<?php $this->options->siteUrl(); ?>"><i class="fa fa-home x5"  aria-hidden="true"></i><?php _e('首页'); ?></a></li>
		            		            <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
		            <?php while($categorys->next()): ?>
		            <?php if ($categorys->levels === 0): ?>
		        	<?php $children = $categorys->getAllChildren($categorys->mid); ?>
					<?php if (empty($children)): ?>
		            	<li class="nav_menu_li"><a id="<?php echo 'menu-mid-'. $categorys->mid ?>" class="nav_menu_lis" href="<?php $categorys->permalink(); ?>"><i class="fa x5 <?php echo $categorys->icon();?>" aria-hidden="true"></i><span><?php $categorys->name(); ?></span></a></li>
					<?php else: ?>
						<li class="nav_menu_li dropdown">
		            		<a id="<?php echo 'menu-mid-'. $categorys->mid ?>" class="navmla nav_menu_lis"  href="<?php $categorys->permalink(); ?>"><i class="fa x5 <?php echo $categorys->icon();?>" aria-hidden="true"></i><span><?php $categorys->name(); ?></span><i class="fontaw fa fa-angle-down"></i></a>
		            		<div class="dropdown-menu" aria-labelledby="topnav-apps">
		            			<?php foreach ($children as $mid) { ?>
								<?php $child = $categorys->getCategory($mid); ?>
		                         <a href="<?php echo $child['permalink'] ?>"  <?php if($this->is('category', $mid)): ?>active<?php endif; ?>"><span id="<?php echo 'menu-mid-'. $child['mid']; ?>" class="dropdown-item"><i class="fa x5 <?php echo $child['icon'];?>" aria-hidden="true"></i><span><?php echo $child['name']; ?></span></span></a>
								<?php } ?>
		            		</div>
		            	</li>
					<?php endif; ?><?php endif; ?><?php endwhile; ?>
					
					<li class="nav_menu_li dropdown"><a class="navmla nav_menu_lis" href="#"><i class="fa fa-caret-square-o-down x5" aria-hidden="true"></i><?php _e('页面'); ?><i class="fontaw fa fa-angle-down"></i></a>
					
					<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
					<div class="dropdown-menu" aria-labelledby="topnav-apps">
            			<?php while($pages->next()): ?><?php if(!($pages->template == 'page-status.php')): ?>
                         <a  href="<?php $pages->permalink(); ?>"><span id="<?php echo 'page-cid-'. $pages->cid ?>" class="dropdown-item "><i class="fa x5 <?php  echo $pages->fields->icon;?>" aria-hidden="true"></i><?php $pages->title(); ?></span></a>
						<?php endif; ?><?php endwhile; ?>
		            </div>
					</li>

	            </ul>

	    	</nav>
				<div class="top-group ht-100">
					<div class="ht-100">
						<ul class="top-group-list ycenter">
							<li class="top-theme-btn tsear"><a class="user-btn cursor toggle-theme"><i class="sw-btn fa fa-1-1x <?php if(strlen($_COOKIE['night']) !== 0){if($_COOKIE["night"]=="1"){echo "fa-sun-o";}else{echo "fa-moon-o";}}else{if($this->options->night == "On"){if(Switch_day()){echo "fa-sun-o";}else{echo "fa-moon-o";}}else{echo "fa-moon-o";}}?>" aria-hidden="true"></i></a></li>
							<li class="top-search-btn "><a class="user-btn cursor md-trigger" data-modal="modal-search"><i class="fa fa-search fa-1-1x" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>	            
		</div>
		</div>
	</div>
<?php $this->need('./component/msidebar.php'); ?>
<?php if($this->is("post") && $this->category !== 'gallery' && $this->category !== 'video'){$this->need('./component/mtoc.php');}?>
</header>

<div id="body">
	