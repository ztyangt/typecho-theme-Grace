<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section id="rightside" style="opacity: 1; transform: translateX(-38px);">
  <div id="r-hide" >
    <a class="cursor toggle-theme"><i class="sw-btn fa <?php if(strlen($_COOKIE['night']) !== 0){if($_COOKIE["night"]=="1"){echo "fa-sun-o";}else{echo "fa-moon-o";}}else{if($this->options->night == "On"){if(Switch_day()){echo "fa-sun-o";}else{echo "fa-moon-o";}}else{echo "fa-moon-o";}}?> ycenter" aria-hidden="true"></i></a>

    <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator") :?>
    <a id="piccolor" class="cursor md-trigger" data-modal="colorSet"><i class="fa fa-tint ycenter" aria-hidden="true"></i></a>
    <?php endif; ?>

    <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && $this->is('post')) :?>
      <a id="postedit" class="cursor md-trigger" data-modal="edit-post"><i class="fa fa-pencil-square ycenter" aria-hidden="true" ></i></a>
    <?php endif; ?>

    <?php if($this->is('post') && $this->category !== 'gallery' && $this->category !== 'video') :?>
    <a id="toc-btn" class="cursor"><i class="fa fa fa-list ycenter" aria-hidden="true"></i></a>
    <a id="m-toc-btn" class="cursor"><i class="fa fa fa-list ycenter" aria-hidden="true"></i></a>
    <?php endif; ?>
  
    <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && $this->is('archive')) :?>
    <a class="cursor md-trigger" data-modal="arc-edit"><i class="fa fa-cogs ycenter" aria-hidden="true" ></i></a>
    <?php endif; ?>

    <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && $this->is('page')) :?>
    <a class="cursor md-trigger" data-modal="page-edit"><i class="fa fa-cogs ycenter" aria-hidden="true" ></i></a>
    <?php endif; ?>

    <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && ($this->template == 'links.php')) :?>
    <a class="cursor delete-link"><i class="fa fa-link ycenter" aria-hidden="true" ></i></a>
    <a class="cursor md-trigger" data-modal="add-link"><i class="fa fa-plus-square ycenter" aria-hidden="true" ></i></a>
    <?php endif; ?>

    <?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && ($this->template == 'talks.php')) :?>
    <a class="cursor edit-talks"><i class="fa fa-pencil-square ycenter" aria-hidden="true" ></i></a>
    <a class="cursor md-trigger" data-modal="add-talk"><i class="fa fa-plus-square ycenter" aria-hidden="true" ></i></a>
    <?php endif; ?>



  </div>
  <div id="r-show">
    <a id="r-config" class="cursor" type="button" title="??????"><div class="ycenter"><i class="fa fa-cog fa-spin " aria-hidden="true"></i></div></a>
    <a id="go-up" class="btn-hidden cursor" type="button" title="????????????"><i class="fa fa-arrow-up ycenter" aria-hidden="true"></i></a>
  </div>
</section>


<div class="md-modal md-effect-1 wd-100 top20" id="modal-search">
  <div class="md-content md-content-search xcenter1">
    <div class="md-close close-icon cursor"><i class="fa fa-times fa-1-3x" aria-hidden="true"></i></div> 
    <div class="search search-bar">
      <form id="top-search" class="wt-100" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
        <input type="text" id="s" class="search-input" name="s" class="text" placeholder="???????????????????????????..." />
        <button class="search-btn cursor" type="submit"></button>
      </form>
    </div>
  </div>
</div>

<div class="md-modal md-effect-2" id="colorSet" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;??????????????????</h3>
        </div>
        <div class="arc-edit-body">
          <div  class="md-link-item piccolor xcenter"></div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
            <div class="xcenter">
              <button id="color-btn" class="page-btn cursor" type="button" data-url="<?php $this->options->siteUrl(); ?>"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;??????</button>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<?php if($this->is('post') && $this->options->reward == "On"): ?>
  <!-- ???????????? -->
<div class="md-modal md-effect-4" id="reward" aria-hidden="true">
	<div class="md-content md-content-reward">
		<div class="reward-box xcenter">   
			<div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div>	
      <h3><i class="fa fa-heart" aria-hidden="true"></i>&nbsp;??????????????????????????????&nbsp;<i class="fa fa-heart" aria-hidden="true"></i></h3>
      <div class="reward-qrcode">
        <div class="xcenter">
          <img src="<?php $this->options->Alipay() ?>" alt="???????????????">
          <img src="<?php $this->options->WCpay() ?>" alt="????????????">
        </div>
      </div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if($this->is('post')): ?>
<!-- ???????????? -->
<div class="md-modal md-modal1" id="poster" aria-hidden="true">
  <div class="md-close close-icon cursor" style="display: none;"><i class="fa fa-times " aria-hidden="true"></i></div> 
	<div class="md-content md-content-poster xcenter1">
      <div id="create-poster" class="poster-box potsize wh-100">
        <div class="poster-img">
          <div class="poster-date"><span><?php Weekday(); ?></span><span><?php echo date("m/d"); ?></span></div>
        </div>
        <div class="poster-info">
          <div class="poster-title"><span id="poster-title" class="h-1x ycenter"></span></div>
          <div class="poster-label"></div>
          <div class="poster-sum"><span></span></div>
        </div>
      </div>
	</div>
</div>
<?php endif; ?>

<?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && $this->is('post')) :?>
<div class="md-modal md-effect-6" id="edit-post" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
        <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;??????????????????</h3>
        </div>
        <div class="arc-edit-body">
          <div class="option">
              <div class="option-text">
                <label class="ycenter editlabel">????????????:</label>
                <input class="radio_input" name="indent" type="radio" value="Yes" id="post-indent-1" <?php if($this->fields->indent == "Yes"){echo 'checked';} ?>>&nbsp;<label class="radio-label">???</label>
                <input name="indent" type="radio" value="No" id="post-indent-0" <?php if($this->fields->indent == "No"){echo 'checked';} ?>>&nbsp;<label class="radio-label">???</label>
              </div>
          </div>
          <div class="option">
              <div class="option-text">
                <label class="ycenter editlabel">????????????:</label>
                <input class="radio_input" name="slide" type="radio" value="Yes" id="post-slide-1" <?php if($this->fields->slide == "Yes"){echo 'checked';} ?>>&nbsp;<label class="radio-label">???</label>
                <input name="slide" type="radio" value="No" id="post-slide-0" <?php if($this->fields->slide == "No"){echo 'checked';} ?>>&nbsp;<label class="radio-label">???</label>
              </div>
          </div>
          <div class="option">
              <div class="option-text">
                <label class="ycenter editlabel">????????????:</label>
                <input class="radio_input" name="topPost" type="radio" value="Yes" id="post-top-1" <?php if($this->fields->topPost == "Yes"){echo 'checked';} ?>>&nbsp;<label class="radio-label">???</label>
                <input name="topPost" type="radio" value="No" id="post-top-0" <?php if($this->fields->topPost == "No"){echo 'checked';} ?>>&nbsp;<label class="radio-label">???</label>
              </div>
          </div>     
         <div class="option">
            <div class="option-text"><label class="ycenter editlabel">????????????:</label></div>
            <input id="post-name-value" class="option-value" name="post-name" type="text" value="<?php $this->title() ?>">
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter editlabel">????????????:</label></div>
            <input id="post-cover-value" class="option-value" name="post-cover" type="text" value="<?php echo showCover($this) ?>" placeholder="?????????????????????????????????...">
          </div>     
          <div class="option">
            <div class="option-text"><label class="ycenter editlabel">??? ??? ???:</label></div>
            <input id="post-keywords-value" class="option-value" name="post-keywords" type="text" value="<?php echo $this->fields->keyword; ?>" placeholder="???????????????????????????????????????...">
          </div>
        <div class="option">
                <div class="option-text"><label class="ycenter editlabel">????????????:</label></div>
                <textarea id="post-desc-value" class="option-value" style="height: 7rem;" name="post-desc" type="text" value="" placeholder="?????????????????????..."><?php echo $this->fields->description; ?></textarea>
            </div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="post-btn" class="arc-btn xcenter cursor" type="button" data-url="<?php  $this->permalink(); ?>" data-cid="<?php  $this->cid(); ?>"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;????????????</button>
          </div>
        </div>
      </div>
  </div>
</div>
<?php endif; ?>


<?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && $this->is('archive')) :?>
<!-- ??????????????? -->
<div class="md-modal md-effect-11" id="arc-edit" aria-hidden="true">
	<div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
        <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;??????????????????</h3>
        </div>
        <div class="arc-edit-body">
         <div class="option">
            <div class="option-text"><label class="ycenter">????????????:</label></div>
            <input id="arc-name-value" class="option-value" name="arc-name" type="text" value="<?php  echo $this->getPageRow()['name'] ?>">
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">????????????:</label></div>
            <input id="arc-cover-value" class="option-value" name="arc-cover" type="text" value="<?php if($this->getPageRow()['cover']){echo $this->getPageRow()['cover'];}else{echo $this->options->coverimg;} ?>">
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">????????????:</label></div>
            <input id="arc-icon-value" class="option-value" name="arc-icon" type="text" value="<?php echo $this->getPageRow()['icon']; ?>" placeholder="??????:fa-wpexplorer">
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">????????????:</label></div>
            <input id="arc-desc-value" class="option-value" name="arc-desc" type="text" value="<?php echo $this->getDescription(); ?>" placeholder="?????????????????????">
          </div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="arc-btn" class="arc-btn xcenter cursor" type="button" data-url="<?php echo $this->getPageRow()['permalink']; ?>" data-mid="<?php echo $this->getPageRow()['mid']; ?>"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;????????????</button>
          </div>
        </div>
        <a class="getawe" href="http://www.fontawesome.com.cn/faicons/" target="_blank">??????????????????</a>
      </div>
	</div>
</div>
<?php endif; ?>

 
<?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && $this->is('page')) :?>
 <!-- ???????????? -->
<div class="md-modal md-effect-11" id="page-edit" aria-hidden="true">
	<div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;??????????????????</h3>
        </div>
        <div class="arc-edit-body">
        <div class="option">
            <div class="option-text"><label class="ycenter">????????????:</label></div>
            <input id="page-cover-value" class="option-value" name="page-cover" type="text" value="<?php if($this->fields->cover){echo $this->fields->cover;}else{echo $this->options->coverimg;} ?>">
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">????????????:</label></div>
            <input id="page-icon-value" class="option-value" name="page-icon" type="text" value="<?php echo $this->fields->icon; ?>" placeholder="??????:fa-wpexplorer">
          </div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="page-btn" class="page-btn xcenter cursor" type="button" data-url="<?php echo $this->permalink(); ?>" data-cid="<?php $this->cid(); ?>"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;????????????</button>
          </div>
        </div>
      </div>
	</div>
</div>
<?php endif; ?>


<?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && ($this->template == 'links.php')): ?>
  <!-- ???????????? -->
<div class="md-modal md-effect-2" id="add-link" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;????????????</h3>
        </div>
        <div class="arc-edit-body">
        <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <input id="links-name-value" class="option-value" name="links-name" type="text" value="">
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <input id="links-url-value" class="option-value" name="links-url" type="text" value="" >
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <input id="links-avatar-value" class="option-value" name="links-avatar" type="text" value="" >
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <textarea id="links-desc-value" class="option-value" style="height: 4rem;" name="links-desc" type="text" value="" placeholder=""></textarea>
          </div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="links-btn" class="page-btn xcenter cursor" type="button" data-url="<?php echo $this->permalink(); ?>" data-cid=""><i class="fa fa-check" aria-hidden="true"></i>&nbsp;??????</button>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="md-modal md-effect-2" id="edit-link" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;????????????</h3>
        </div>
        <div class="arc-edit-body">
        <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <input id="links-name-value1" class="option-value" name="links-name" type="text" value="">
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <input id="links-url-value1" class="option-value" name="links-url" type="text" value="" >
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <input id="links-avatar-value1" class="option-value" name="links-avatar" type="text" value="" >
          </div>
          <div class="option">
            <div class="option-text"><label class="ycenter">??????:</label></div>
            <input id="links-desc-value1" class="option-value" name="links-desc" type="text" value="" >
          </div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="links-edit-btn" class="page-btn xcenter cursor" type="button" data-url="<?php echo $this->permalink(); ?>" data-cid="<?php  ?>"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;??????</button>
          </div>
        </div>
      </div>
  </div>
</div>


<div class="md-modal md-effect-2" id="links-delete" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;???????????????????????????</h3>
        </div>
        <div class="arc-edit-body">
          <div  class="md-link-item xcenter">
              <div class="links-box">
                  <img class="transform delete-avatar" src="">
                  <div class="link-ship">
                    <h2 class="h-1x delete-name"></h2>
                    <p class="h-2x delete-desc"></p>
                  </div>
                </div>
              </div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
            <div class="xcenter">
              <button id="de-link-btn" class="page-btn cursor" type="button" data-url="<?php echo $this->permalink(); ?>" data-lid=""><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Yes</button>
              <button id="cansel-btn" class="page-btn cursor" type="button"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;No</button>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<?php endif; ?>


<?php $admin = get_object_vars($this->user)['row']['group']; if ($admin == "administrator" && ($this->template == 'talks.php')) :?>
<div class="md-modal md-effect-2" id="add-talk" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;????????????</h3>
        </div>

        <form method="post" action="<?php echo $this->permalink; ?> ">
        <div class="arc-edit-body">
            <div class="option">
                <div class="option-text">
                  <label class="ycenter">??????:</label>
                  <input class="radio_input" name="talk-type" type="radio" value="text" id="talk-text" checked>&nbsp;<label class="radio-label">??????</label>
                  <input name="talk-type" type="radio" value="image" id="talk-image">&nbsp;<label class="radio-label">??????</label>
                  <input name="talk-type" type="radio" value="video" id="talk-video">&nbsp;<label class="radio-label">??????</label>
                </div>
              </div>
              <div class="option">
                <div class="option-text"><label class="ycenter">??????:</label></div>
                <input id="talk-meta-value" class="option-value" name="talk-mata" type="text" value="" placeholder="??????????????????????????????">
              </div>
              <div class="option">
                <div class="option-text"><label class="ycenter">??????:</label></div>
                <textarea id="talk-text-value" class="option-value" name="talk-text" type="text" value="" placeholder="???????????????..."></textarea>
            </div>
        </div>

        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="add-talk-btn" class="page-btn xcenter cursor" type="submit" data-url="<?php echo $this->permalink(); ?>" data-tid=""><i class="fa fa-check" aria-hidden="true"></i>&nbsp;??????</button>
          </div>
        </div>
        </form>
      </div>
  </div>
</div>


<div class="md-modal md-effect-2" id="talks-delete" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;???????????????????????????</h3>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
            <div class="xcenter">
              <button id="de-talk-btn" class="page-btn cursor" type="button" data-url="<?php echo $this->permalink(); ?>" data-tid=""><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Yes</button>
              <button id="cansel-btn" class="page-btn cursor" type="button"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;No</button>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="md-modal md-effect-2" id="edit-talk" aria-hidden="true">
  <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;????????????</h3>
        </div>

        <form method="post" action="<?php echo $this->permalink; ?> ">
        <div class="arc-edit-body">
            <div class="option">
                <div class="option-text">
                  <label class="ycenter">??????:</label>
                  <input class="talk-tid" name="talk-tid" type="hidden" value="">
                  <input class="radio_input" name="talk-type1" type="radio" value="text" id="talk-text1" checked>&nbsp;<label class="radio-label">??????</label>
                  <input name="talk-type1" type="radio" value="image" id="talk-image1">&nbsp;<label class="radio-label">??????</label>
                  <input name="talk-type1" type="radio" value="video" id="talk-video1">&nbsp;<label class="radio-label">??????</label>
                </div>
              </div>
              <div class="option">
                <div class="option-text"><label class="ycenter">??????:</label></div>
                <input id="talk-meta-value1" class="option-value" name="talk-mata1" type="text" value="" placeholder="??????????????????????????????">
              </div>
              <div class="option">
                <div class="option-text"><label class="ycenter">??????:</label></div>
                <textarea id="talk-text-value1" class="option-value" name="talk-text1" type="text" value="" placeholder="???????????????..."></textarea>
            </div>
        </div>

        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="edit-talk-btn" class="page-btn xcenter cursor" type="submit" data-url="<?php echo $this->permalink(); ?>" data-tid=""><i class="fa fa-check" aria-hidden="true"></i>&nbsp;??????</button>
          </div>
        </div>
        </form>
      </div>
  </div>
</div>
<?php endif; ?>


<?php if(!$this->user->hasLogin()): ?>
<div class="md-modal md-effect-10" id="login" aria-hidden="true">
  <div class="md-content md-content-login">
    <div class="login-box xcenter1">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
      <div class="login-top xcenter"><span>??????</span></div>
      <form action="<?php $this->options->loginAction()?>" method="post" name="login" rold="form">
        <div class="login-center clearfix">
          <div class="login-center-img"><img src="<?php $this->options->themeUrl('img/name.png'); ?>" class="wh-100"></div>
          <div class="login-center-input">
            <input type="hidden" name="referer" value="<?php $this->options->siteUrl(); ?>">
            <input type="text" name="name" autocomplete="username" value="" placeholder="????????????????????????" onfocus="this.placeholder=''" onblur="this.placeholder='????????????????????????'"/>
            <div class="login-center-input-text">?????????</div>
          </div>
        </div>
        <div class="login-center clearfix">
          <div class="login-center-img"><img src="<?php $this->options->themeUrl('img/password.png'); ?>" class="wh-100"/></div>
            <div class="login-center-input">
              <input type="password" name="password" autocomplete="current-password" value="" placeholder="?????????????????????" onfocus="this.placeholder=''" onblur="this.placeholder='?????????????????????'"/>
              <div class="abs-right passw"><i class="fa-fw fa fa-eye"></i></div>
            <div class="login-center-input-text">??????</div>
          </div>
        </div>
        <button class="login-button cursor xcenter" type="submit">??????</button>
      </form>
    </div>
  </div>
</div>

<div class="md-modal md-effect-10" id="register" aria-hidden="true">
  <div class="md-content md-content-register ">
    <div class="login-box xcenter1">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
      <div class="login-top xcenter"><span>??????</span></div>

      <form action="<?php $this->options->registerAction();?>" method="post" name="register" role="form">
        <div class="login-center clearfix">
          <div class="login-center-img"><img src="<?php $this->options->themeUrl('img/name.png'); ?>" class="wh-100"></div>
          <div class="login-center-input">
            <input type="hidden" name="_" value="<?php echo $this->security->getToken($this->request->getRequestUrl());?>">
            <input type="text" id="name" name="name"  value="" placeholder="????????????????????????" onfocus="this.placeholder=''" onblur="this.placeholder='????????????????????????'"/>
            <div class="login-center-input-text">?????????</div>
          </div>
        </div>

        <div class="login-center clearfix">
          <div class="login-center-img"><img src="<?php $this->options->themeUrl('img/password.png'); ?>" class="wh-100"/></div>
            <div class="login-center-input">
              <input type="email"  name="mail" value="" placeholder="???????????????Email" onfocus="this.placeholder=''" onblur="this.placeholder='???????????????Email'"/>
            <div class="login-center-input-text">??????</div>
          </div>
        </div>
        <button class="login-button cursor xcenter" type="submit" name="loginsubmit" value="true">??????</button>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>


<?php if($this->is('index')): ?>
  <!-- ???????????? -->
<div class="md-modal md-effect-7" id="jiami" aria-hidden="true">
 <div class="md-content md-content-arc">
      <div class="arc-edit-box xcenter">
      <div class="md-close close-icon cursor"><i class="fa fa-times " aria-hidden="true"></i></div> 
        <div class="arc-edit-head">
          <h3><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;?????????????????????</h3>
        </div>
        <div class="arc-edit-body">
        <div class="option">
            <div class="option-text"><label class="ycenter">????????????:</label></div>
            <input id="post-password" class="post-password option-value" name="post-password" type="password" value="">
          </div>
        </div>
        <div class="arc-edit-footer">
          <div class="option-sub">
          <button id="post-pass" class="page-btn xcenter cursor" type="button" tocken=""><i class="fa fa-check" aria-hidden="true"></i>&nbsp;??????</button>
          </div>
        </div>
      </div>
  </div>
</div>
<?php endif; ?>