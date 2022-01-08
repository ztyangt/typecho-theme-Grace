<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="incard">
    <div class="col-top">
        <ul class="column-title nav nav-pills">
            <li class="intitle"><a data-target="#new-update" data-toggle="pill">最近更新</a></li>
            <li class="intitle"><a data-target="#hotcomt-post" data-toggle="pill">热门文章</a></li>
            <li class="intitle"><a data-target="#hotview-post" data-toggle="pill">最多浏览</a></li>
            <li class="intitle"><a data-target="#suiji-post" data-toggle="pill">随机推荐</a></li>
            
        </ul>
    </div>
    <div class="tab-content">

        <div class="tab-pane" id="new-update">
            <ul class="list-group flex-wrap">
                <?php $recentUpdate = recentUpdate(10); ?>
                <?php if ($recentUpdate) : $i = 0; ?>
                    <?php foreach ($recentUpdate as $updatetarr) : $cid = $updatetarr['cid'];
                        $this->widget('Widget_Archive@newupdate' . $cid, 'pageSize=1&type=post', 'cid=' . $cid)->to($updatepost); ?><?php $i += 1; ?>
                    <li class="list-group-item <?php if ($this->options->tagpage == "page2") {echo "page2";}else{echo "page1";} ?> ">
                        <a class="tab-img" href="<?php $updatepost->permalink(); ?>"><img class="lazy wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($updatepost); ?>" alt="<?php $updatepost->title(); ?>"></a>
                        <div class="tab-item">
                            <a href="<?php $updatepost->permalink(); ?>">
                                <span class="h-1x">
                                    <span class="number-style" style="background-color:rgb(<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>)"><?php echo $i; ?>
                                    </span><?php $updatepost->title(); ?>
                                </span>
                            </a>
                            <div class="hotdet">
                                <span class="spot"><?php $updatepost->author() ?></span><span><?php echo "更新于". time_diff(getUpdateTime($cid)); ?></span>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?><?php endif; ?>
            </ul>
        </div>
        
        <div class="tab-pane" id="hotcomt-post">
            <ul class="list-group flex-wrap">
                <?php $getHotcomts = getHotcomts(10); ?>
                <?php if ($getHotcomts) : $i = 0; ?>
                    <?php foreach ($getHotcomts as $hotcomtarr) : $cid = $hotcomtarr['cid'];
                        $this->widget('Widget_Archive@hotcomt' . $cid, 'pageSize=1&type=post', 'cid=' . $cid)->to($hotcomtpost); ?><?php $i += 1; ?>
                    <li class="list-group-item <?php if ($this->options->tagpage == "page2") {echo "page2";}else{echo "page1";}?>  ">
                        <a class="tab-img" href="<?php $hotcomtpost->permalink(); ?>"><img class="lazy wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($hotcomtpost); ?>" alt="<?php $hotcomtpost->title(); ?>"></a>
                        <div class="tab-item">
                            <a href="<?php $hotcomtpost->permalink(); ?>">
                                <span class="h-1x">
                                    <span class="number-style" style="background-color:rgb(<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>)"><?php echo $i; ?>
                                    </span><?php $hotcomtpost->title(); ?>
                                </span>
                            </a>
                            <div class="hotdet">
                                <span class="spot"><?php $hotcomtpost->author() ?></span><span><?php echo time_diff($hotcomtpost->created); ?></span>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?><?php endif; ?>
            </ul>
        </div>

        <div class="tab-pane" id="hotview-post">
            <ul class="list-group flex-wrap">
                <?php $getHotviews = getHotviews(10); ?>
                <?php if ($getHotviews) : $i = 0; ?>
                    <?php foreach ($getHotviews as $hotarr) : $cid = $hotarr['cid'];
                        $this->widget('Widget_Archive@hot' . $cid, 'pageSize=1&type=post', 'cid=' . $cid)->to($hotpost); ?><?php $i += 1; ?>
                    <li class="list-group-item <?php if ($this->options->tagpage == "page2") {echo "page2";}else{echo "page1";} ?> ">
                        <a class="tab-img" href="<?php $hotpost->permalink(); ?>"><img class="lazy wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($hotpost); ?>" alt="<?php $hotpost->title(); ?>"></a>
                        <div class="tab-item">
                            <a href="<?php $hotpost->permalink(); ?>">
                                <span class="h-1x">
                                    <span class="number-style" style="background-color:rgb(<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>)"><?php echo $i; ?>
                                    </span><?php $hotpost->title(); ?>
                                </span>
                            </a>
                            <div class="hotdet">
                                <span class="spot"><?php $hotpost->author() ?></span><span><?php echo time_diff($hotpost->created); ?></span>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?><?php endif; ?>
            </ul>
        </div>

        <div class="tab-pane" id="suiji-post">
            <ul class="list-group flex-wrap">
                <?php $radompost = random_posts(10); ?>
                <?php if ($radompost) : $i = 0; ?>
                    <?php foreach ($radompost as $post) : $cid = $post['cid'];
                        $this->widget('Widget_Archive@radom' . $cid, 'pageSize=1&type=post', 'cid=' . $cid)->to($post); ?><?php $i += 1; ?>
                    <li class="list-group-item <?php if ($this->options->tagpage == "page2") {echo "page2";}else{echo "page1";} ?> ">
                        <a class="tab-img" href="<?php $post->permalink(); ?>"><img class="lazy wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($post) ?>" alt="<?php $post->title(); ?>"></a>
                        <div class="tab-item">
                            <a href="<?php $post->permalink(); ?>">
                                <span class="h-1x">
                                    <span class="number-style" style="background-color:rgb(<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>,<?php echo (rand(50, 200)); ?>)"><?php echo $i; ?>
                                    </span><?php $post->title(); ?>
                                </span>
                            </a>
                            <div class="hotdet">
                                <span class="spot"><?php $post->author() ?></span><span><?php echo time_diff($post->created); ?></span>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?><?php endif; ?>
            </ul>
        </div>


    </div>

</div>