<?php 
/**
 * 关于
 * @author 南玖 https://ztongyang.cn
 * @package custom 
 * 
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>

<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<div class="col-mb-12 col-8" id="main" role="main">
<div class="archive-bg">
        <div class="diy-archive-bg wh-100" style="background-image: url(<?php if($this->fields->cover){echo $this->fields->cover;}else{echo $this->options->coverimg;} ?>);">
            <div class="about-page-name">
                    <?php $this->title(); ?>
            </div> 
            <span class="default-cover"><?php echo $this->options->coverimg ?></span>
            <div class="aner"></div>
        </div>
</div>
<div class="layout-page">
    <div class="page">
    <article  class="page-post ab-article" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="about-row">
            <div class="ab-side hide7">
                <div class="xcenter">
                    <ul class="user-info">
                    <li><span class="user-tags c-blue hint--top" aria-label="发布<?php $stat->publishedPostsNum() ?>篇文章">
                        <i class="fa fa-file-text-o x5" aria-hidden="true"></i><?php $stat->publishedPostsNum() ?>
                    </span></li>
                    <li><span class="user-tags c-yellow hint--top" aria-label="一共<?php $stat->publishedCommentsNum() ?>条评论">
                        <i class="fa fa-commenting-o x5" aria-hidden="true"></i><?php $stat->publishedCommentsNum() ?></i>
                    </span></li>
                    <li><span class="user-tags c-green hint--top" aria-label="<?php $stat->categoriesNum() ?>个文章分类">
                        <i class="fa fa-bar-chart x5" aria-hidden="true"></i> <?php $stat->categoriesNum() ?></i>
                    </span></li>
                    <li><span class="user-tags c-red hint--top" aria-label="站点总字数：<?php allOfCharacters(); ?>">
                        <i class="fa fa-file-word-o x5" aria-hidden="true"></i><?php allOfCharacters(); ?></i>
                    </span></li>
                    </ul>
                </div>
            </div>
            <div class="ab-center">
                <div class="ab-avatar-box">
                    <img class="ab-avatar xcenter" src="<?php echo $this->options->avatar?>"  alt="关于">
                </div>
                <div class="ab-name">
                    <h2 class="xcenter"><?php $this->options->title() ?></h2>
                    
                </div>
            </div>
            <div class="ab-side hide7">
                <div class="xcenter">
                    <ul class="ab-link">
                    <li class="ab-item qq cursor hint--top hint--rounded" aria-label="QQ联系我：<?php echo $this->options->QQ ?>"><i class="fa fa-qq" aria-hidden="true"></i></li>
                    <li class="ab-item weixin cursor hint--top hint--rounded" aria-label="微信联系我：<?php echo $this->options->wechat ?>"><i class="fa fa-weixin" aria-hidden="true"></i></li>
                    <li class="ab-item mail cursor hint--top hint--rounded" aria-label="邮箱联系我：<?php echo $this->user->mail ?>"><i class="fa fa-envelope" aria-hidden="true"></i></li>
                    <li class="ab-item github cursor hint--top hint--rounded" aria-label="点击访问我的GitHub"><a style="color: #fff;" href="<?php echo $this->options->github ?>"><i class="fa fa-github" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ab-desc"><span class="xcenter"><?php $this->options->description() ?></span></div>
        <div class="ab-show7">
            <div class="ab7">
                <div class="xcenter">
                    <ul class="user-info">
                    <li><span class="user-tags c-blue hint--top" aria-label="发布<?php $stat->publishedPostsNum() ?>篇文章">
                        <i class="fa fa-file-text-o x5" aria-hidden="true"></i><?php $stat->publishedPostsNum() ?>
                    </span></li>
                    <li><span class="user-tags c-yellow hint--top" aria-label="一共<?php $stat->publishedCommentsNum() ?>条评论">
                        <i class="fa fa-commenting-o x5" aria-hidden="true"></i><?php $stat->publishedCommentsNum() ?></i>
                    </span></li>
                    <li><span class="user-tags c-green hint--top" aria-label="<?php $stat->categoriesNum() ?>个文章分类">
                        <i class="fa fa-bar-chart x5" aria-hidden="true"></i> <?php $stat->categoriesNum() ?></i>
                    </span></li>
                    <li><span class="user-tags c-red hint--top" aria-label="站点总字数：<?php allOfCharacters(); ?>">
                        <i class="fa fa-file-word-o x5" aria-hidden="true"></i><?php allOfCharacters(); ?></i>
                    </span></li>
                    </ul>
                </div>
            </div>

            <div class="ab7">
                <div class="xcenter">
                    <ul class="ab-link">
                    <li class="ab-item qq cursor hint--top hint--rounded" aria-label="QQ联系我：<?php echo $this->options->QQ ?>"><i class="fa fa-qq" aria-hidden="true"></i></li>
                    <li class="ab-item weixin cursor hint--top hint--rounded" aria-label="微信联系我：<?php echo $this->options->wechat ?>"><i class="fa fa-weixin" aria-hidden="true"></i></li>
                    <li class="ab-item mail cursor hint--top hint--rounded" aria-label="邮箱联系我：<?php echo $this->user->mail ?>"><i class="fa fa-envelope" aria-hidden="true"></i></li>
                    <li class="ab-item github cursor hint--top hint--rounded" aria-label="点击访问我的GitHub"><a style="color: #fff;" href="<?php echo $this->options->github ?>"><i class="fa fa-github" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>                
        </div>
        <div class="ab-post">
        <div id="page-post" class="aboutp post-content" itemprop="articleBody">
        <?php echo parseBiaoQing($this->content); ; ?>

        </div>
        </div>
    </article>
    <div class="comment-box cts">
     <?php $this->need('comments.php'); ?>
    </div>
    </div>
    </div>
</div>

<?php $this->need('./includes/footer.php'); ?>