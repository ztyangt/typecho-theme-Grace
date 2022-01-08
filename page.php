<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('./includes/header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
<div class="layout-page">

    <div class="page">
    <article class="page-post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>
    <div class="comment-box">
     <?php $this->need('comments.php'); ?>
    </div>
    </div>
    </div>
</div><!-- end #main-->

<?php $this->need('./includes/footer.php'); ?>
