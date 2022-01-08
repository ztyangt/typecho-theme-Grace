<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

    </div>
</div>

<footer id="footer" role="contentinfo">
    <div class="footer">
        <div class="footer-info">
            <div class="footer-top wd-100">
                <div class="xcenter fr2">
                    <span class="social-item cursor hint--top hint--rounded" aria-label="QQ联系我：<?php echo $this->options->QQ ?>"><i class="fa fa-qq" aria-hidden="true"></i></span>
                    <span class="social-item cursor hint--top hint--rounded" aria-label="微信联系我：<?php echo $this->options->wechat ?>"><i class="fa fa-weixin" aria-hidden="true"></i></span>
                    <span class="social-item cursor hint--top hint--rounded" aria-label="邮箱联系我：<?php echo $this->options->email ?>"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                </div>
                <div class="footer-left fl1">
                    <div class="c5">
                        <div class="fcenter">
                            <?php foreach (array_filter(explode(PHP_EOL, $this->options->footerLinks)) as $uitem) : ?>
                                <a href="<?php echo trim(explode("$",$uitem)[1]); ?>"><?php echo trim(explode("$",$uitem)[0]); ?></a>
                            <?php endforeach; ?>
                            
                            <a class="hide38" target="_blank" href="http://beian.miit.gov.cn">|&nbsp;<img style="height:1rem;position: relative;top:2px;" src="<?php $this->options->themeUrl('img/icp.png'); ?>" />&nbsp;<?php $this->options->beian(); ?></a>
                        </div>

                        <span class="typed-text"><?php $this->options->typed_text(); ?></span>                        
                    </div>
                    <a class="show38 xcenter" target="_blank" href="http://beian.miit.gov.cn"><img style="height:1rem;position: relative;top:2px;" src="<?php $this->options->themeUrl('img/icp.png'); ?>" />&nbsp;<?php $this->options->beian(); ?></a>
					<div class="typed-cursor"><span id="typed"></span></div>
                </div>
                <div class="footer-right fr1">
                    <span class="social-item cursor hint--top hint--rounded" aria-label="QQ联系我：<?php echo $this->options->QQ ?>"><i class="fa fa-qq" aria-hidden="true"></i></span>
                    <span class="social-item cursor hint--top hint--rounded" aria-label="微信联系我：<?php echo $this->options->wechat ?>"><i class="fa fa-weixin" aria-hidden="true"></i></span>
                    <span class="social-item cursor hint--left hint--rounded" aria-label="邮箱联系我：<?php echo $this->options->email ?>"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="footer-bottom">
                <div>Copyright &copy; <?php if(date("Y",strtotime($this->options->settime)) !== date("Y",time())){echo date("Y",strtotime($this->options->settime)).'-'.date("Y",time());}else{echo date("Y",time()); }?> · <?php $this->options->title();?> ·  由 <a href="http://www.typecho.org">Typecho</a> 强力驱动</div>
            </div>

        </div>

    </div>

</footer>
<div id="extra-pane">
    <?php $this->need('./component/extrapane.php'); ?>
    <div class="md-overlay"></div>
    <div class="filetype" data-list="<?php echo $this->options->fileType; ?>"></div>
</div>


<div>
    <script src="<?php $this->options->themeUrl('assets/js/grace.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/main.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/fancybox.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/colpick.min.js'); ?>"></script>
</div>


</body>
</html>
