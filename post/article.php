
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    <div style="display: none;"><link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/HLstyle/'.$this->options->HLstyle.'.min.css')
; ?>"></div>
    <?php if ($this->options->sider_layout == "layout2" && $this->options->sideWidget) {$this->need('./includes/sidebar.php');} ?>
    <div class="post-layout post-shadow">
        <article id="postcavans" class="post <?php if($this->fields->indent == 'Yes'){echo 'textindent';}  ?>" >
            <?php $this->need('component/posthead.php'); ?>
            <div id="article" class="pcontent" itemprop="articleBody">
                <?php 
                $lazyimg = $this->options->themeUrl.'/img/loading.gif';
                $content = preg_replace('#<img([^<>]*?)src=\"([^<>]*?)\"([^<>]*?)>#', "<a href=\"\$2\" data-fancybox=\"gallery\" /><img class='lazy' \$1data-original=\"\$2\" src=\"".$lazyimg."\"\$3></a>", $this->content,-1);
                echo Parsepost($content); 
                ?>
            </div>
            <div class="post-copyright">
                <div class="post-copyright-info"><span class="cometa"><i class="fa fa-user x5" aria-hidden="true"></i>文章作者：</span><span><?php $this->author(); ?></span></div>
                <div class="post-copyright-info"><span class="cometa"><i class="fa fa-link x5" aria-hidden="true"></i>文章链接：</span><span><?php $this->permalink(); ?></span></div>
                <div class="post-copyright-info"><span class="cometa"><i class="fa fa-exclamation-circle x5" aria-hidden="true"></i>文章声明：</span><span>本文观点不代表立场，转载请联系原作者。</span></div>
            </div>         
            <div class="post-foot-box">
                <ul class="post-foot ">
                    <?php if($this->options->reward == "On"):?>
                        <li><button class="pbtn post-btn ycenter md-trigger" data-modal="reward"><i class="fa fa-heart-o" style="color: red;" aria-hidden="true"></i>&nbsp;打赏</button></li>
                    <?php endif; ?>
                    <?php if($this->options->poster == "On"): ?>
                        <li>
                            <button id="creatposter" class="pbtn post-btn ycenter md-trigger" data-modal="poster"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;海报</button>
                        </li>
                    <?php endif; ?>
                    <?php if($this->options->thumbUp == "On"): ?>
                        <li>
                            <button id="ThumbUp-btn1" class="pbtn post-btn ycenter" <?php echo getThumbUps($this->cid)['recording']?'disabled':''; ?> type="button"  data-cid="<?php echo $this->cid; ?>" data-url="<?php $this->permalink(); ?>">
                            <i class="fa fa-thumbs-o-up " aria-hidden="true"></i>&nbsp;点赞</button>
                        </li>
                    <?php endif; ?>
                    </ul>
            </div>
        </article>
        <ul class="post-near">
        <?php   $prev_post = GthePrev($this);
                $next_post = GtheNext($this);
                $prev_cid = $prev_post['cid'];
                $prev_title = $prev_post['title'];
                $prev_link = $prev_post['permalink'];
                $prev_time = date('Y-m-d',$prev_post['created']);
                $this->widget('Widget_Archive@prev', 'pageSize=1&type=post', 'cid='.$prev_cid)->to($prev);
                $prev_cover = $prev->fields->cover;
                $next_cid = $next_post['cid'];
                $next_title = $next_post['title'];
                $next_link = $next_post['permalink'];
                $next_time = date('Y-m-d',$next_post['created']);
                $this->widget('Widget_Archive@next', 'pageSize=1&type=post', 'cid='.$next_cid)->to($next);
                $next_cover = $next->fields->cover;
                $default_cover = $this->options->coverimg;
        ?>
            <li style="margin-right: 3px;background-image: url(<?php if($prev_post){if($prev_cover){echo $prev_cover;}else{echo $default_cover; }}else{echo $default_cover;} ?>);">
                <a class="prev_box wh-100" href="<?php echo $prev_link; ?>">
                    <div class="prev-1">
                        <span style="float: left;"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;上一篇</span>
                        <span style="float: right;"><?php if($prev_post){echo $prev_time;}else{echo '------';} ?></span>
                    </div> 
                    <div class="h-1x"><?php if($prev_post){echo $prev_title;}else{echo '没有了';} ?></div>
                </a>
            </li>
            <li style="margin-left: 3px;background-image: url(<?php if($next_post){if($next_cover){echo $next_cover;}else{echo $default_cover; }}else{echo $default_cover;} ?>);">
                <a class="next_box wh-100" href="<?php echo $next_link; ?>">
                    <div class="next-1">
                        <span style="float: right;">下一篇&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                        <span style="float: left;"><?php if($next_post){echo $next_time;}else{echo '------';} ?></span>
                    </div>
                    <div class="h-1x"><?php if($next_post){echo $next_title;}else{echo '没有了';} ?></div>
                </a>
            </li>
        </ul>
        <div class="comment-box"><?php $this->need('comments.php'); ?></div>
    </div>
    <?php if ($this->options->sider_layout == "layout1" && $this->options->sideWidget) {$this->need('./includes/sidebar.php');} ?>
