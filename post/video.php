
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    <?php if ($this->options->sider_layout == "layout2" && $this->options->sideWidget) {$this->need('./includes/sidebar.php');} ?>
<script src="https://cdn.jsdelivr.net/npm/flv.js/dist/flv.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js/dist/hls.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script> 
<div class="post-layout">
<div class="gallery-page wd-100">
	<?php $this->need('component/posthead.php'); ?>
	<div class="video" logo="<?php echo $this->options->vlogo; ?>">
		<?php $videos=array_values(array_filter(explode(PHP_EOL, str_replace("<!--markdown-->","",getContent($this->cid)))));?>
		<div id="dplayer" play-url="<?php echo explode('$',$videos[0])[1]; ?>" class='player'></div>

	<div class="video-widget">
		<div class="card-title"><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp;&nbsp;剧集</div>
			<ul class="v-list flex-wrap">
			    <?php foreach ($videos as $video): ?>
			    <li><button class="play-btn cursor play" data-url="<?php echo(explode("$", $video)[1]); ?>"><?php echo(explode("$", $video)[0]); ?></button></li>
			    <?php endforeach;?>
			</ul>
			<div class="video-desc">
				<?php echo $this->fields->description; ?>
			</div>
	</div>
	</div>
</div>
 <div class="comment-box"><?php $this->need('comments.php'); ?></div>
</div>
    

<?php if ($this->options->sider_layout == "layout1" && $this->options->sideWidget) {$this->need('./includes/sidebar.php');} ?>
