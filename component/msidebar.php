<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="msidebar" class="mobile-sidebar scale">
	<?php if (in_array("user-widget", $this->options->sideWidget)) : ?>
 		<?php $this->need('./component/userinfo.php'); ?>
	<?php endif; ?>
	<div class="card-widget">
		<div class="side-menu">
     	<ul>
         	<li class="side-li"><a class="whb" href="<?php $this->options->siteUrl(); ?>"><i class="fa fa-home x5"  aria-hidden="true"></i><?php _e('首页'); ?></a></li>
	        <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
			<?php while($categorys->next()): ?>
			<?php if ($categorys->levels === 0): ?>
			<?php $children = $categorys->getAllChildren($categorys->mid); ?>
			<?php if (empty($children)): ?>
	        <li  class="side-li"><a id="m-menu-<?php  $categorys->mid() ?>" class="whb" href="<?php $categorys->permalink(); ?>" ><i class="fa x5 <?php echo $categorys->icon();?>" aria-hidden="true"></i><?php $categorys->name(); ?></a></li>
	        <?php else: ?>
			<li  class="side-li mdrop extend-<?php  $categorys->mid() ?>" c-mid="extend-<?php  $categorys->mid() ?>"><a id="m-menu-<?php  $categorys->mid() ?>" class="whb"><i class="fa x5 <?php echo $categorys->icon();?>" aria-hidden="true"></i><?php $categorys->name(); ?><i class="fa fa-angle-right iright" aria-hidden="true"></i></a></li>
			<li  id="extend-<?php  $categorys->mid() ?>" class="drop-list transform" data-num="<?php echo count($children); ?>">
				<ul class="side-ul">
				<?php foreach ($children as $mid) { ?>
				<?php $child = $categorys->getCategory($mid); ?>
					<li class="m-dropdown"><a id="m-menu-<?php echo $mid ?>" class="whb" href="<?php echo $child['permalink'] ?>" class="whb1"><i class="fa x5 <?php echo $child['icon'];?>" aria-hidden="true"></i><?php echo $child['name']; ?></a></li><?php } ?>
				</ul>
			</li>	
			<?php endif; ?><?php endif; ?><?php endwhile; ?>
					
			<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
			<li  class="side-li extend-pages mdrop cursor" c-mid="extend-pages"><a class="whb" ><i class="fa fa-caret-square-o-down x5" aria-hidden="true"></i>页面<i class="fa fa-angle-right iright" aria-hidden="true"></i></a></li>
			<?php $i = 0;while($pages->next()){$i+=1;} ?>
			<li id="extend-pages" class="drop-list transform" data-num="<?php echo $i; ?>">
				<ul class="side-ul" >
					<?php while($pages->next()): ?><?php if(!($pages->template == 'page-status.php')): ?>
					<?php $child = $pages->getCategory($mid); ?>
					<li class="m-dropdown"><a id="m-page-<?php $pages->cid();  ?>" class="whb" href="<?php $pages->permalink(); ?>" ><i class="fa x5 <?php  echo $pages->fields->icon;?>" aria-hidden="true"></i><?php $pages->title(); ?></a></li>
					<?php endif; ?><?php endwhile; ?>
				</ul>
			</li>	
     	</ul>
     	</div>
	</div>

	<?php $this->need('./component/side.php'); ?>

</div>
<div id="m-overlay" class="m-overlay wh-100"></div>