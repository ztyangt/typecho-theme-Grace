
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="gallery-post">
<div class="gallery-page wd-100">
	<?php $this->need('component/posthead.php'); ?>
	<ul class="gallery-list flex-wrap">
		<?php $imgs=array_values(array_filter(explode(PHP_EOL, str_replace("<!--markdown-->","",getContent($this->cid))))); 
		foreach($imgs as $img):?>
		<li class="gallery-item">
			<div class="g-img cursor" data-src="<?php echo $img; ?>" data-fancybox="gallery">
				<img class="wh-100 lazy transform" data-original="<?php echo $img; ?>" src="<?php echo $this->options->lazyimg; ?>">
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<div class="comment-box"><?php $this->need('comments.php'); ?></div>
</div>


