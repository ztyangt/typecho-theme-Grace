<?php

/**
 * <div style="color:#2997f7;">一个优美的Typecho主题</div>
 * 
 * @package Grace
 * @author 南玖
 * @version 3.0.0
 * @link https://www.ztyang.com/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;$this->need('./includes/header.php');?>
<div class="layout-page">
<?php if ($this->options->index_layout == "layout2") {$this->need('./component/slides.php');} ?>
<div class="index-content">
	<?php if ($this->options->sider_layout == "layout2" && $this->options->sideWidget) {$this->need('./includes/sidebar.php');} ?>
	<div class="index-layout">
		<?php if ($this->options->index_layout == "layout1") {$this->need('./component/slides.php');} ?>
		<?php $this->need('./component/tagspage.php'); ?>
		<?php $this->need('./component/postlist.php'); ?>
	</div>
	<?php if ($this->options->sider_layout == "layout1" && $this->options->sideWidget) {$this->need('./includes/sidebar.php');} ?>
</div>
</div>

<?php $this->need('./includes/footer.php'); ?>
