<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if (in_array("nav-links", $this->options->sideWidget)) : ?>
	<div class="card-widget">
		<div class="card-title"><p class="mycard_title"><i class="fa fa-codiepie" aria-hidden="true"></i><?php $this->options->navname() ?></p></div>
		<div class="card-ul">
			<ul style="padding: 2px;">
				<?php foreach (array_filter(explode(PHP_EOL, $this->options->navLinks)) as $navlink) : ?>
					<li class="navlink"><a href="<?php echo trim(explode("$",$navlink)[1]); ?>">
						<img src="<?php echo trim(explode("$",$navlink)[2]); ?>">
						<div class="nav-info">
							<h4><?php echo trim(explode("$",$navlink)[0]); ?></h4>
							<p class="nav-p"><?php echo trim(explode("$",$navlink)[3]); ?></p>
						</div>
                <?php endforeach; ?>				
			</ul>
		</div>
	</div>
<?php endif; ?>

<?php if (in_array("new-update", $this->options->sideWidget)) : ?>
	<div class="card-widget">
	<div class="card-title"><p class="mycard_title"><i class="fa fa-book" aria-hidden="true"></i>最近更新</p></div>
		<div class="card-ul">
			<ul>
				<?php $recentUpdate = recentUpdate(6); ?>
				<?php if ($recentUpdate) : $i = 0; ?>
					<?php foreach ($recentUpdate as $updatetarr) : $cid = $updatetarr['cid'];
						$this->widget('Widget_Archive@sidenewupdate' . $cid, 'pageSize=1&type=post', 'cid=' . $cid)->to($sideupdat); ?><?php $i += 1; ?>
					<li class="side-update">
						<div class="update-post">
							<a class="wh-100" href="<?php $sideupdat->permalink(); ?>" style="background-image: url('<?php echo showCover($sideupdat); ?>')"></a>
						</div>
						<div class="newpost-content">
							<a class="h-2x" href="<?php $sideupdat->permalink(); ?>"><span class="h-2x htitle"><?php $sideupdat->title(); ?></span></a>
							<div class="newpost-time">
								<span><?php echo "更新于" . time_diff(getUpdateTime($cid)); ?></php></span>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>

<?php if (in_array("tags-cloud", $this->options->sideWidget)) : ?>
	<div class="card-widget">
	<div class="card-title"><p class="mycard_title"><i class="fa fa-tags" aria-hidden="true"></i>标签云</p></div>
		<div class="tag">
			<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
			<?php if ($tags->have()) : ?>
				<?php while ($tags->next()) : ?>
					<a class="black" href="<?php $tags->permalink(); ?>" title="该标签下有<?php $tags->count(); ?>篇文章">
					<span class="tag-item" style="background:rgba(<?php echo (rand(150, 200)); ?>,<?php echo (rand(150, 255)); ?>,<?php echo (rand(150, 255)); ?>,.5)"><?php $tags->name(); ?>
					</span></a>
				<?php endwhile; ?>
			<?php else : ?>
				<span>暂无标签</span>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<?php if (in_array("web-widget", $this->options->sideWidget)) : ?>
	<div class="card-widget">
		<div class="card-title"><p class="mycard_title"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i>网站详情</p></div>
		<div class="card-ul">
			<ul>
				<li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;加载耗时:<span class="badge"><?php timer_stop(); ?></span></li>
				<li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;发布文章:<span class="badge"><?php $stat->publishedPostsNum() ?>篇</span></li>
				<li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;评论总数:<span class="badge"><?php $stat->publishedCommentsNum() ?>条</span></li>
				<li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;字数统计:<span class="badge"><?php allOfCharacters(); ?></span></li>
				<li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;文章分类:<span class="badge"><?php timer_stop(); ?></span></li>
				<li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;运行时间:<span class="badge"><?php getBuildTime(); ?></span></li>
				<li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;当前日期:<span class="badge"><?php echo date('Y-m-d D', time()); ?></span></li>
			</ul>
		</div>
	</div>
<?php endif; ?>