<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="card-widget">
	<section>
	<div style="padding-bottom: 10px;"><p class="mycard_title"><i class="fa fa-tags" aria-hidden="true"></i>个人名片</p></div>
      <div class="sidebg"><img class="wh-100" src="<?php $this->options->sidebg(); ?>"></div>
	  <ul class="userinfolist pt-1">
        <li><span>NAME</span><?php if ($this->user->hasLogin()) {$this->user->screenName();} else {$this->options->title();} ?></li>
        <?php if($this->options->job): ?> 
			<li><span>JOB</span><?php $this->options->job(); ?></li>
		<?php endif; ?>
        <?php if($this->options->addr): ?> 
			<li><span>ADDR</span><?php $this->options->addr(); ?></li>
		<?php endif; ?>
        <?php if($this->options->QQ): ?> 
			<li><span>QQ</span><?php $this->options->QQ(); ?></li>
		<?php endif; ?>
        <?php if($this->options->WC): ?> 
			<li><span>WC</span><?php $this->options->wechat(); ?></li>
		<?php endif; ?>
        <?php if($this->options->email): ?> 
			<li><span>EMAIL</span><?php $this->options->email(); ?></li>
		<?php endif; ?>
      </ul>
    </section>



</div>