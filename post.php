<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('./includes/header.php'); ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/fancybox.min.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/post.css'); ?>">
<?php if(preg_match('#\[video\s+url([\s\S]*)cover#', $this->content) !== 0):?>
<script src="https://cdn.jsdelivr.net/npm/flv.js/dist/flv.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js/dist/hls.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script>
<?php endif; ?>
<div class="post-bg">
    <div id="wrapper">
        <div id="particles-js" class="diy-bg" style="background-image: url(<?php echo showCover($this); ?>);">
            <canvas class="particles-js-canvas-el" style="width: 100%; height: 100%;"></canvas>
            <div class="top-post-title">
            <h2 id="top-post-title"><?php $this->title() ?></h2>
            <span class="default-cover"><?php echo $this->options->coverimg ?></span>
        </div>
        </div>
        <script id="jscanvas" src="<?php $this->options->themeUrl('assets/js/particles.min.js'); ?>"></script>
    </div>
</div>
<div class="layout-page">


<div class="post-content flex ">
    <?php if($this->category == "gallery"){
        $this->need('./post/gallery.php');
    } else if ($this->category == "video"){
        $this->need('./post/video.php');
    } else {
        $this->need('./post/article.php');
    }
    ?>

</div>

<div style="display: none;">
    <?php if($this->category !== 'gallery' && $this->category !== 'video'): ?>
        <div id="poster-cover"><?php echo GrabImage(showCover($this)); ?></div>
        <div id="AvaImage"><?php echo AvaImage($this->options->avatar); ?></div>
        <div id="poster-Wd"><?php Weekday() ?></div>
        <div id="poster-Dt"><?php echo date("m/d"); ?></div>
        <div id="qrcode-url"><?php $this->permalink(); ?></div>
        <div id="poster-description"><?php if($this->fields->description){$description = $this->fields->description;}else{ $description = $this->description;};echo parseBiaoQing($description); ?></div>     
        
        <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.7/dist/html2canvas.min.js"></script>
        <script src="<?php $this->options->themeUrl('assets/js/qrcode.min.js'); ?>"></script>           
        <script src="<?php $this->options->themeUrl('assets/js/prism.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('assets/js/clipboard.min.js'); ?>"></script>
        <?php if(preg_match('#\$\$([\s\S]*)\$\$#', $this->content) !== 0):?>
        <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
        <?php endif; ?>
        <?php if(preg_match('#flow([\s\S]*)#', $this->content) !== 0):?>
        <script src="<?php $this->options->themeUrl('assets/js/raphael.min.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('assets/js/flowchart.min.js'); ?>"></script>
        <?php endif; ?>
    <?php endif; ?>
        <script src="<?php $this->options->themeUrl('assets/js/post.js'); ?>"></script>
</div>


<?php $this->need('./includes/footer.php'); ?>