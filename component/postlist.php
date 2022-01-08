<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if(!empty(getTopPost())): ?>
<div><span class="icard">置顶文章</span></div>
<ul class="toppost flex-wrap shadow">
<?php $topCidArr = getTopPost();for($i=0;$i<count($topCidArr);$i++): $this->widget('Widget_Archive@topPost'.$i, 'pageSize=1&type=post', 'cid='.$topCidArr[$i])->to($topPost);?>
    <li class="bxb">
        <a class="wh-100" href="<?php echo $topPost->permalink; ?>">
            <div class="wh-100 topcover">
                <img class="wh-100" src="<? echo showCover($topPost); ?>">
                <div class="toptag"><span><i class="fa x5 fa-star-o" aria-hidden="true"></i>置顶</span></div>
            </div>
            <div class="toppost-info">
                <div class="toppost-title"><span class="h-1x"><?php echo $topPost->title; ?></span></div>
            </div>
        </a>
    </li>
<?php endfor; ?>           
</ul>
<?php endif; ?>
<div id="post-box">
<?php if($this->options->post_style =="list1"):?>
<div><span class="icard">最新发布</span></div>

<div class="post-box-item">
<?php while($this->next()):?>
    <?php if($this->fields->description){$description = $this->fields->description;}else{ $description = $this->excerpt;} ?>
    <div class="post-card-1 <?php if($this->hidden){echo 'jiami cursor md-trigger';} ?>" <?php if($this->hidden){echo 'data-modal="jiami" data-url='.Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink);} ?> >
    <div class="post-box-1">
        <a class="recent-img" href="<?php $this->permalink(); ?>">
            <div class="recent-cover wh-100"><img class="lazy transform wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($this); ?>" alt="<?php $this->title(); ?>"></div>
        </a>
        <div class="recent-info">
            <a href="<?php $this->permalink(); ?>">
                <a class="recent-title rt2 h-1x" href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a>
                <div class="recent-desc">
                    <a class="recent-title rt1 h-1x" href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a>
                    <span class="h-2px"><?php echo parseBiaoQing($description); ?></span>
                </div>
            </a>
            <div class="ls-r"><a href="<?php $this->permalink(); ?>"></a><a class="post-label" href="<?php echo $this->categories[0]["permalink"]; ?>" title="查看更多分类文章"><i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;<?php echo $this->categories[0]["name"]; ?></a>
            <span><?php if($this->tags){for($i=0;$i<count($this->tags);$i++){echo '<span class="tags-list">#'.$this->tags[$i]["name"].'</span>';}}?></span>
        </div>
            <div class="post-detail">
                <span class="spot"><?php $this->author();?></span><span><?php echo timesince($this->created); ?></span>
                <div class="post-detail2"><span class="pl-time"><i class="fa fa-clock-o"></i>&nbsp;<?php echo date("Y-m-d", $this->created);?></span><span><i class="fa fa-eye fs-16"></i>&nbsp;<?php echo getViews($this->cid); ?></span><span><i class="fa fa-commenting"></i>&nbsp;<?php $this->commentsNum(); ?></span></div>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
</div>
<?php endif; ?>


<?php if($this->options->post_style =="list2"):?>
<div><span class="icard">最新发布</span></div>
<div class="post-box-item">
<div class="flex flex-wrap">
    <?php if ($this->have()) : ?><?php while ($this->next()) : ?>
    <?php if ($this->fields->description) {$description = $this->fields->description;} else {$description = $this->description;} ?>
    <div class="card-item">
        <div class="post-card-2 <?php if($this->hidden){echo 'jiami cursor md-trigger';} ?>" <?php if($this->hidden){echo 'data-modal="jiami" data-url='.Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink);} ?>>
            <div class="post-img-2">
                <a class="img-content" href="<?php $this->permalink(); ?>" title="<?php $this->title(); ?>">
                    <img class="wh-100 lazy" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($this); ?>" alt="<?php $this->title(); ?>">
                    <div class="a-title"><span class="h-1x"><?php $this->title(); ?></span></div>
                </a>
            </div>
            <div class="card-item-bottom bottom-radius">
                <div class="h-1x">
                    <span class="post-label1"><?php echo $this->categories[0]["name"]; ?></span>
                    <?php if ($this->tags) {for ($i = 0; $i < count($this->tags); $i++) {echo '<span class="tags-list">#' . $this->tags[$i]["name"] . '</span>';}} ?></div>
                <div class="a-summary">
                    <span class="h-2x"><a class="recent-desc" href="<?php $this->permalink(); ?>" title="<?php $this->title(); ?>"><?php echo parseBiaoQing($description); ?></a></span>
                </div>
                <div class="post-footer">
                    <span class="spot"><?php $this->author();?></span><span><?php echo timesince($this->created); ?></span>
                    <div class="fright"><span><i class="fa fa-eye fs-16"></i>&nbsp;<?php echo getViews($this->cid); ?></span>&nbsp;<span><i class="fa fa-commenting"></i>&nbsp;<?php $this->commentsNum(); ?></span>&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?><?php endif; ?>
</div></div>
<?php endif; ?>
<a class="more-btn xcenter cursor loadmore">点击加载更多...</a>
</div>
<div class="nextpost"><?php $this->pageLink('下一页','next'); ?></div>

