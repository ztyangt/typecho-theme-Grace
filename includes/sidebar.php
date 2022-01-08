<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="side-layout sidebar" <?php if ($this->options->index_layout == "layout1") {echo 'style="padding-top:10px;"';} ?>>


 <?php if($this->is('post')) :?>
	<?php $this->need('./component/toc.php'); ?>
 <?php endif; ?>
	 
<div class="sidex">
 	<?php if (in_array("user-widget", $this->options->sideWidget)) : ?>
 		<?php $this->need('./component/userinfo.php'); ?>
	<?php endif; ?>

	<?php $this->need('./component/side.php'); ?>

 </div>

</div>
