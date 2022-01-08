<?php 
/**
 * 友链
 * @author 南玖 https://ztongyang.cn
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>
<div class="col-mb-12 col-8" id="main" role="main">
<div class="archive-bg">
        <div class="diy-archive-bg wh-100" style="background-image: url(<?php if($this->fields->cover){echo $this->fields->cover;}else{echo $this->options->coverimg;} ?>);">
            <div class="gl-page-name">
                    <?php $this->title(); ?>
            </div> 
            <span class="default-cover"><?php echo $this->options->coverimg ?></span>
            <div class="aner"></div>
        </div>
</div>
    <div class="layout-page">
        <div class="page">
            <div class="page-post links-row">
                    <div class="links-page flex-wrap">
                    <?php $links = echoLinks(); foreach ($links as $link ) :?>
                        <div id="link-<?php echo $link['lid'] ?>" class="link-item">
                            <div class="links-box">
                                <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && ($this->template == 'links.php')): ?>
                                <div class="links-edit wh-100 hidden" >
                                    <div class="edit-link wd-50 cursor md-trigger" aria-label="编辑" data-modal="edit-link" data-lid="<?php echo $link['lid'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></div>
                                    <div class="de-link wd-50 cursor md-trigger" aria-label="删除" data-modal="links-delete"  data-lid="<?php echo $link['lid'] ?>"><i class="fa fa-trash" aria-hidden="true" ></i></div>
                                </div>
                            <?php endif; ?>
                                <a  href="<?php echo $link['url'] ?>" >
                                <img class="transform" src="<?php echo $link['avatar'] ?>">
                                <div class="link-ship">
                                    <h2 class="h-1x"><?php echo $link['name'] ?></h2>
                                    <p class="h-2x"><?php echo $link['desc'] ?></p>
                                </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="links-post">
                        <div id="page-post" class="post-content linksp" itemprop="articleBody">
                            <?php echo Parsepost($this->content); ; ?>
                        </div>
                    </div>

                       <div class="comment-box" style="padding: 0!important;">
                         <?php $this->need('comments.php'); ?>
                        </div>                    
            </div>
        </div>
    </div>
</div>

<?php $this->need('./includes/footer.php'); ?>
