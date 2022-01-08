<?php 
/**
 * 归档
 * @author 南玖 https://ztongyang.cn
 * @package custom 
 * 
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>
<?php
$this->widget('Widget_Contents_Post_Recent', 'pageSize=1000000')->to($archives);
Typecho_Widget::widget('Widget_Stat')->to($stat);
$data_arr = array();
while ($archives->next()){array_push($data_arr,date('Y-m',$archives->created));}
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
            <div class="page-post arclist-post">
                <div class="chart">
                <div id="chart-1" class="gdtu wh-100"></div>
                </div>
                <div class="guidang">
                <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($arcpost);?>
                    <?php  while($arcpost->next()): $year_tmp = date('Y',$arcpost->created);$mon_tmp = date('m',$arcpost->created);?>
                    <?php if($year != $year_tmp): $year = $year_tmp;  ?>
                    </ul><div class="year"><span><?php echo $year; ?></span></div>
                    <?php endif; ?>
                    <?php if($mon != $mon_tmp): $mon = $mon_tmp;  ?>
                    </ul><div class="g-item"><span class="month"><?php echo $mon . '月'; ?></span></div><ul class="g-list">
                    <?php endif; ?>
                    <li class="transform ">
                        <a class="g-card block" style="background-image: url(<?php echo showCover($arcpost) ?>);" href="<?php echo $arcpost->permalink ?>">
                            <div class="g-info wh-100">
                                <div class="g-item-title h-2x"><?php echo $arcpost->title ?></div>
                                <div class="g-item-time"><?php echo date('Y-m-d ',$arcpost->created); ?></div>
                            </div>
                        </a>
                    </li>
                    <?php endwhile; ?> 
                </div>
            </div>
            <div id="remove" style="display: none;">
                <span id="color1"></span>
                <span id="color2"></span>
                <span id="theme-color"></span>
                <span id="chart-x-data"><?php echo(echart_data($data_arr)[0]);?></span>
                <span id="chart-y-data"><?php echo(echart_data($data_arr)[1]);?></span>
                <span id="chart-start"><?php echo date("Y-m",strtotime('-10 month',strtotime(date("Y-m"))));?></span>
                <span id="chart-start1"><?php echo date("Y-m",strtotime('-7 month',strtotime(date("Y-m"))));?></span>
                <span id="chart-start2"><?php echo date("Y-m",strtotime('-7 month',strtotime(date("Y-m"))));?></span>
            </div>
        </div>
    </div>
</div>




<script src="https://lib.baomitu.com/echarts/4.7.0/echarts.min.js"></script>    
<?php $this->need('./includes/footer.php'); ?>
