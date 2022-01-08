<?php if($this->is('index')){
		$image = $this->options->coverimg;
	}elseif($this->is("page")) {
		if($this->fields->cover){$image = $this->fields->cover;}else{$image = $this->options->coverimg;}
	}elseif($this->is("archive")) {
		if($this->getPageRow()['cover']){$image = $this->getPageRow()['cover'];}else{$image = $this->options->coverimg;}
	}elseif($this->is("post")){
		$image = showCover($this);
	}
	if($this->is("post")){$description=$this->fields->description; }else{$description = $this->options->description;}
	?>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta property="og:title" content="<?php $this->archiveTitle(array('category'=>_t('分类 %s 下的文章'),'search'=>_t('包含关键字 %s 的文章'),'tag'=>_t('标签 %s 下的文章'),'author'=>_t('%s 发布的文章')), '', ' - ')?><?php $this->options->title(); ?>"/>
	<meta property="og:description" content="<?php echo $description;?>">  
	<meta property="og:url" content="<?php $this->permalink() ?>"/> 
	<meta itemprop="name" content="<?php $this->archiveTitle(array('category'=>_t('分类 %s 下的文章'),'search'=>_t('包含关键字 %s 的文章'),'tag'=>_t('标签 %s 下的文章'),'author'=>_t('%s 发布的文章')), '', ' - ')?><?php $this->options->title(); ?>">
	<meta itemprop="description" content="<?php echo $description; ?>">
	<meta itemprop="image" content="<?php echo $image ?>" />
    <title><?php if($this->is('index')){ $this->options->title();} ?><?php $this->archiveTitle(array('category'=>_t('分类 %s 下的文章'),'search'=>_t('包含关键字 %s 的文章'),'tag'=>_t('标签 %s 下的文章'),'author'=>_t('%s 发布的文章')), '', '')?></title>
	<meta name="keywords" content="<?php $keywords=$this->fields->keyword;if(empty($keywords) || !$this->is('single')){echo $this->keywords();}else{ echo $keywords;};?>" />
	<meta name="description" content="<?php echo $description; ;?>" />
    <link rel="icon" href="<?php echo $this->options->favicon; ?>" mce_href="<?php echo $this->option->favicon; ?>" type="image/x-icon">
    <?php $this->header('description=&keywords=&enerator=&template=&pingback=&xmlrpc=&wlw=&rss1=&rss2=&atom='); ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/grace.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/loading.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/hint.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/colpick.min.css'); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
	<script src="<?php $this->options->themeUrl('assets/js/sidebar.min.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('assets/js/slide.min.js'); ?>"></script>
	<?php echo $this->options->tongji ?>
	<style><?php $rgb = hex2rgb(getThemeColor()); ?>:root{--theme-color:rgb(<?php echo $rgb['r'].','.$rgb['g'].','.$rgb['b'];?>);--theme-bg-color:rgb(<?php echo $rgb['r'].','.$rgb['g'].','.$rgb['b']; ?>,.1);--theme-bg-color1:rgb(<?php echo $rgb['r'].','.$rgb['g'].','.$rgb['b'];?>,.3);--theme-bg-color2:rgb(<?php echo $rgb['r'].','.$rgb['g'].','.$rgb['b'];?>,.5);--theme-bg-color3:rgb(<?php echo $rgb['r'].','.$rgb['g'].','.$rgb['b'];?>,.7)}
	<?php echo $this->options->diycss; ?>
</style>