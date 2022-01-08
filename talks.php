<?php 
/**
 * 说说
 * @author 南玖 https://ztongyang.cn
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/fancybox.min.css'); ?>">
<script src="https://cdn.jsdelivr.net/npm/flv.js/dist/flv.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js/dist/hls.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script>
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
    <div class="talks-page layout-page">
        <div class="page">
            <div class="page-post talk-post">
            <?php $talks = echoTalks(); foreach ($talks as $talk ) :?>
             	<div id="talk-<?php echo $talk['tid'] ?>" class="talk-item" type="<?php echo $talk['type'] ?>">
                    <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && ($this->template == 'talks.php')) :?>
                    <div class="talks-edit hidden" >
                        <div class="edit-talk cursor md-trigger hint--top hint--rounded" aria-label="编辑" data-modal="edit-talk" data-tid="<?php echo $talk['tid'] ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></div>
                        <div class="de-talk cursor md-trigger hint--top hint--rounded" aria-label="删除" data-modal="talks-delete"  data-tid="<?php echo $talk['tid'] ?>"><i class="fa fa-trash" aria-hidden="true" ></i></div>       
                    </div>
                <?php endif; ?>
                    <span class="talk-url"><?php echo $talk['image'];echo $talk['video']; ?></span>
                	<div class="talk-head">
                		<div class="talk-avatar">
                			<img src="<?php $this->options->avatar() ?>">
                		</div>
                		<div class="talk-info">
                			<div class="talk-author"><?php $this->author(); ?></div>
                			<div class="talk-time"><?php echo time_diff($talk['created']) ?></div>
                		</div>
                	</div>
                	<div class="talk-content">
                		<span class="talk-text"><?php echo $talk['text'] ?></span>
                        <?php if($talk['type'] == 'image'): ?>
                            <div class="talk-meta">
                                <a href="<?php echo $talk['image']; ?>" data-fancybox="gallery">
                                <img class="lazy xcenter" data-original="<?php echo $talk['image']; ?>" src="<?php echo $this->options->lazyimg ?>" /></a>
                            </div>                            
                        <?php endif; ?>
                        <?php if($talk['type'] == 'video'): ?>
                            <div id="talk-video-<?php echo $talk['tid']; ?>" class="talk-video" data-url="<?php echo $talk['video']; ?>" data-tid="<?php echo $talk['tid']; ?>" data-logo="<?php echo $this->options->vlogo;?>"></div>
                        <?php endif; ?>
                	</div>
             	</div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="<?php $this->options->themeUrl('assets/js/fancybox.min.js'); ?>"></script>

</div>

<?php $this->need('./includes/footer.php'); ?>
