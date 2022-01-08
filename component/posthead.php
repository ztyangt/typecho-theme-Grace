<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<ul class="phead">
<li class="pcate"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;<?php $this->category('&nbsp;›&nbsp;'); ?></li>
    <li class="ptags">
        <?php foreach ($this->tags as $tag): ?>
	    <span class="post-tags head-post-tags" ><i class="fa fa-tags x5" aria-hidden="true"></i><?php echo $tag['name']; ?></span>
	    <?php endforeach;?>
    </li>
</ul>

<div class="post-meta wd-100">
    <ul class="post-avatar">
        <li><div class="post-img">
            <img alt="<?php $this->options->title() ?>" src="<?php $this->options->avatar() ?>" class="avatar wh-100 ">
        </div></li>
        <li><div class="pinfo"><span class="pauthor"><?php $this->author(); ?></span>
            <span class="update" time="<?php echo date('Y-m-d',getUpdateTime($this->cid)); ?>">
                <?php if($this->options->thumbUp == "On"): ?>
                <i class="fa x3 fa-thumbs-o-up" aria-hidden="true">&nbsp;<item id="thumb-num"><?php echo getThumbUps($this->cid)["ThumbUp"]; ?></item></i>
            <?php endif; ?>
                <i class="fa x3 fa-file-word-o" aria-hidden="true">&nbsp;<?php echo art_count($this->cid); ?></i>
                <i class="fa x3 fa-commenting" aria-hidden="true">&nbsp;<?php $this->commentsNum(); ?></i>
                <i class="fa x3 fa-eye" aria-hidden="true">&nbsp;<?php Postviews($this); echo getViews($this->cid); ?></i>
            </span>
        </div></li>
        <li class="hide7" style="padding-left: 1rem;display: none;">
            <?php if($this->options->thumbUp == "On"): ?>
            <button id="ThumbUp-btn" class="pbtn post-btn ycenter" <?php echo getThumbUps($this->cid)['recording']?'disabled':''; ?> type="button"  data-cid="<?php echo $this->cid; ?>" data-url="<?php $this->permalink(); ?>"><i class="fa fa-thumbs-o-up " aria-hidden="true"></i>&nbsp;点赞</button>
            <?php endif; ?>
            <?php if($this->options->reward == "On"): ?>
            <button class="pbtn post-btn ycenter md-trigger " data-modal="reward"><i class="fa fa-heart-o" style="color: red;" aria-hidden="true"></i>&nbsp;打赏</button>
            <?php endif; ?>

        </li>
          

    </ul>
    <div class="post-date ht-100">
        <span class="update" time="<?php echo date('Y-m-d',getUpdateTime($this->cid)); ?>"><?php echo "更新于". time_diff(getUpdateTime($this->cid)); ?>
        <span class=""><?php $this->date("Y/m/d"); ?></span>
        </span>
    </div>
</div>