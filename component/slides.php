<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="slide-box">
  <div class="slide-21">
    <div class="flexslider slide1 wh-100"> 
      <ul class="slides wh-100"> 
        <?php if($this->options->banner_ctrl == "On"): ?>

          <?php $slide_list = array_reverse(slide_ctrl());if(count($slide_list) !== 0): ?>
            <?php foreach($slide_list as $slide_cid): $cid = $slide_cid['cid'];$this->widget('Widget_Archive@banner'.$cid, 'pageSize=1&type=post', 'cid='.$cid)->to($slide);?>
              <li><a href="<?php echo $slide->permalink; ?>">
                <img src="<?php echo showCover($slide); ?>" alt="<?php echo $slide->title; ?>" /><span class="overlay"></span>
                <div class="slide-info"><p class="slide-info-top"><?php echo $slide->title; ?></p><p><?php if($this->options->duanju == "On"){echo duanju();}else{$this->options->description();}?></p></div>
              </a></li> 
            <?php endforeach; ?>
        <?php else: ?>
          <li>
            <img src="<?php echo $this->options->coverimg; ?>" /><span class="overlay"></span>
            <div class="slide-info"><p class="slide-info-top"><?php $this->options->title();?></p><p><?php if($this->options->duanju == "On"){echo duanju();}else{$this->options->description();}?></p></div>
          </li> 
        <?php endif; ?>
        <?php else: ?>
          <li>
            <img src="<?php echo $this->options->coverimg; ?>" />
            <div class="slide-info"><p class="slide-info-top"><?php $this->options->title();?></p><p><?php if($this->options->duanju == "On"){echo duanju();}else{$this->options->description();}?></p></div>
          </li> 
        <?php endif; ?>

      </ul> 
</div>
  </div>
</div>

