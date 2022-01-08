<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
class Typecho_Widget_Helper_PageNavigator_Box extends Typecho_Widget_Helper_PageNavigator
{
    /**
     * from 泽泽社长(https://qqdie.com/archives/typecho-hepage-functions.html)
     * 输出盒装样式分页栏
     *
     * @access public
     * @param string $prevWord 上一页文字
     * @param string $nextWord 下一页文字
     * @param int $splitPage 分割范围
     * @param string $splitWord 分割字符
     * @param string $currentClass 当前激活元素class
     * @return void
     */
    public function render($prevWord = 'PREV', $nextWord = 'NEXT', $splitPage = 3, $splitWord = '...', array $template = array())
    { 
        if ($this->_total < 1) {
            return;
        }
        $default = array(
            'aClass'  =>  '',
            'itemTag'       =>  'li',
            'textTag'       =>  'span',
            'textClass'       =>  '',
            'currentClass'  =>  'current',
            'prevClass'     =>  'prev',
            'nextClass'     =>  'next'
        );
        $template = array_merge($default, $template);
        extract($template);
        // 定义item
        $itemBegin = empty($itemTag) ? '' : ('<' . $itemTag . '>');
        $itemCurrentBegin = empty($itemTag) ? '' : ('<' . $itemTag 
            . (empty($currentClass) ? '' : ' class="' . $currentClass . '"') . '>');
        $itemPrevBegin = empty($itemTag) ? '' : ('<' . $itemTag 
            . (empty($prevClass) ? '' : ' class="' . $prevClass . '"') . '>');
        $itemNextBegin = empty($itemTag) ? '' : ('<' . $itemTag 
            . (empty($nextClass) ? '' : ' class="' . $nextClass . '"') . '>');
        $itemEnd = empty($itemTag) ? '' : ('</' . $itemTag . '>');
        $textBegin = empty($textTag) ? '' : ('<' . $textTag 
            . (empty($textClass) ? '' : ' class="' . $textClass . '"') . '>');
        $textEnd = empty($textTag) ? '' : ('</' . $textTag . '>');

        $linkBegin = '<a href="%s" '. (empty($aClass) ? '' : ' class="' . $aClass . '"') . '>';
        $linkCurrentBegin = empty($itemTag) ? ('<a href="%s"'
            . (empty($currentClass) ? '' : ' class="' . $currentClass . '"') . '>')
            : $linkBegin;
        $linkPrevBegin = empty($itemTag) ? ('<a href="%s"'
            . (empty($prevClass) ? '' : ' class="' . $prevClass . '"') . '>')
            : $linkBegin;
        $linkNextBegin = empty($itemTag) ? ('<a href="%s"'
            . (empty($nextClass) ? '' : ' class="' . $nextClass . '"') . '>')
            : $linkBegin;
        $linkEnd = '</a>';
        $from = max(1, $this->_currentPage - $splitPage);
        $to = min($this->_totalPage, $this->_currentPage + $splitPage);
        //输出上一页
        if ($this->_currentPage > 1) {
            echo $itemPrevBegin . sprintf($linkPrevBegin,
                str_replace($this->_pageHolder, $this->_currentPage - 1, $this->_pageTemplate) . $this->_anchor)
                . $prevWord . $linkEnd . $itemEnd;
        }
        //输出第一页
        if ($from > 1) {
            echo $itemBegin . sprintf($linkBegin, str_replace($this->_pageHolder, 1, $this->_pageTemplate) . $this->_anchor)
                . '1' . $linkEnd . $itemEnd;
            if ($from > 2) {
                //输出省略号
                echo $itemBegin . $textBegin . $splitWord . $textEnd . $itemEnd;
            }
        }
        //输出中间页
        for ($i = $from; $i <= $to; $i ++) {
            $current = ($i == $this->_currentPage);
            
            echo ($current ? $itemCurrentBegin : $itemBegin) . sprintf(($current ? $linkCurrentBegin : $linkBegin),
                str_replace($this->_pageHolder, $i, $this->_pageTemplate) . $this->_anchor)
                . $i . $linkEnd . $itemEnd;
        }
        //输出最后页
        if ($to < $this->_totalPage) {
            if ($to < $this->_totalPage - 1) {
                echo $itemBegin . $textBegin . $splitWord . $textEnd . $itemEnd;
            }
            
            echo $itemBegin . sprintf($linkBegin, str_replace($this->_pageHolder, $this->_totalPage, $this->_pageTemplate) . $this->_anchor)
                . $this->_totalPage . $linkEnd . $itemEnd;
        }
        //输出下一页
        if ($this->_currentPage < $this->_totalPage) {
            echo $itemNextBegin . sprintf($linkNextBegin,
                str_replace($this->_pageHolder, $this->_currentPage + 1, $this->_pageTemplate) . $this->_anchor)
                . $nextWord . $linkEnd . $itemEnd;
        }
    }
}
?>
<?php $this->need('./includes/header.php'); ?>

    <div class="col-mb-12 col-8" id="main" role="main">
        <h3 class="archive-title" style="display: none;"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h3>

<div class="archive-bg">
        <div class="diy-archive-bg wh-100" style="background-image: url(<?php if($this->getPageRow()['cover']){echo $this->getPageRow()['cover'];}else{echo $this->options->coverimg;} ?>);">
            <div class="aner"></div>
            <div class="top-archive-title">
                <div class="arc-name">
                    <?php echo $this->getPageRow()['name']; ?>
                </div> 
                <span class="default-cover"><?php echo $this->options->coverimg ?></span>
                <div class="arc-desc"></div>
        </div>
        </div>

</div>

<div class="layout-page">
    <div class="archive-list">

    <?php if ($this->have()): ?>

        <?php if($this->category == 'gallery'):  ?>
            <?php while($this->next()): ?>
                <div class="gallery-card">
                    <div class="arc-item wh-100 shadow">
                        <div class="arc-cover arc-32">
                            <a href="<?php $this->permalink(); ?>">
                            <img class="lazy scale wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($this); ?>" alt="<?php $this->title();?>">
                            <span class="overlay"></span>
                            </a>
                            <div class="gal-name"><?php $this->title();?></div>
                            <div class="gal-num"><?php echo count(array_filter(explode(PHP_EOL, str_replace("<!--markdown-->","",getContent($this->cid)))));?><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php elseif($this->category == 'video'): ?>
            <?php while($this->next()): ?>
                <div class="gallery-card">
                    <div class="arc-item wh-100 shadow">
                        <div class="arc-cover arc-32">
                            <a href="<?php $this->permalink(); ?>">
                            <img class="lazy scale wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($this); ?>" alt="<?php $this->title();?>">
                            <span class="overlay"></span>
                            </a>
                            <div class="gal-name"><?php $this->title();?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <?php while($this->next()): ?>
                <div class="c-card">
                    <div class="arc-item wh-100 shadow">
                        <div class="arc-cover arc-169">
                            <a href="<?php $this->permalink(); ?>" title="<?php $this->title();?>">
                            <img class="lazy scale wh-100" src="<?php echo $this->options->lazyimg ?>" data-original="<?php echo showCover($this); ?>" alt="<?php $this->title();?>">
                            <span class="overlay"></span>
                            </a>
                        </div>
                        <div class="arc-content">
                            <div class="arc-title">
                                <a class="h-2x" href="<?php $this->permalink(); ?>" title="<?php $this->title();?>"><?php $this->title();?></a>
                            </div>
                            <div class="arc-bottom">
                                <span><i class="fa fa-clock-o"></i><?php echo date("Y-m-d", $this->created) ?></span>
                                <div style="float:right;">
                                    <?php if($this->options->thumbUp == "On"): ?>
                                <span class="dn5"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?php echo getThumbUps($this->cid)["ThumbUp"]; ?></span><?php endif; ?>
                                <span><i class="fa fa-eye" aria-hidden="true"></i><?php Postviews($this); echo getViews($this->cid); ?></span>
                                <span class="dn5"><i class="fa fa-commenting" aria-hidden="true"></i><?php $this->commentsNum(); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php else: ?>
        <article class="post">
            <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
        </article>
    <?php endif; ?>
    </div>
        <div class="col-btn">
			<?php $this->pageNav('«', '»', 2, '···', array('wrapTag' => 'ul', 'wrapClass' => 'nav-links', 'itemTag' => 'li','aClass' => 'page-numbers','textClass' => 'page-numbers', 'currentClass' => 'page-numbers current', 'prevClass' => 'page-numbers prev', 'nextClass' => 'next page-numbers',)); ?>
		</div>

</div>

    </div>

    <?php $this->need('./includes/footer.php'); ?>
    <script>
    var type = new Typed(".arc-desc", {
        strings: ["<?php echo $this->getDescription(); ?>"],
        startDelay: 300,
        typeSpeed: 120,
        loop: true,
        backSpeed: 100,
        directionNav: false,
        showCursor: false
    });
    </script>
