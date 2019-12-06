<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh">


<head>
    <meta charset="utf-8" />
   

	<!-- 元数据 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="author" content="ArtTemplate" />
    <meta name="description" content="vCard" />

    <!-- Twitter数据 -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ArtTemplates">
    <meta name="twitter:title" content="vCard">
    <meta name="twitter:description" content="vCard">
    <meta name="twitter:image" content="assets/images/social.jpg">

    <!-- Open Graph data一套Metatags的规格，用来标注你的页面，告诉我们你的网页代表哪一类型的现实世界物件。 -->
    <meta property="og:title" content="ArtTemplate" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="your url website" />
    <meta property="og:image" content="assets/images/social.jpg" />
    <meta property="og:description" content="vCard" />
    <meta property="og:site_name" content="vCard" />

	<!-- 网站头像 -->
	<link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/apple-touch-icon-57x57.png">
    <link rel="shortcut icon" href="assets/images/favicons/favicon.png" type="image/png">
    
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 样式 -->
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('assets/styles/style.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('assets/styles/ideal.css'); ?>"/>
    <?php $this->header(); ?>
</head>
<!-- 分离菜单的按钮 -->
<body class="bg-triangles">
    <!-- 加载进度 -->
    <!-- <div class="preloader"> -->
	    <!-- <div class="preloader__wrap">
		    <div class="circle-pulse">
                <div class="circle-pulse__1"></div>
                <div class="circle-pulse__2"></div>
            </div>
		   
		</div> -->
	<!-- </div> -->

<main class="main">
	<div class="container gutter-top">
		<div class="row sticky-parent">
		<!-- 调用sidebar侧边栏 -->
		<?php $this->need('sidebar.php'); ?>
		        
				<!-- 内容 -->
		        <div class="col-12 col-md-12 col-xl-9">
                    
				    <div class="box pb-0">
					    <!-- 菜单 -->
					    <div class="circle-menu">
						    <div class="hamburger">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="sidebar"><!-- 侧栏里的内容 不需要被刷新 -->
						<div class="inner-menu">
						    <ul class="nav">
                                <!-- 右上角 -->
			<?php
				$hideHomeItem = false;
				if(!empty(Typecho_Widget::widget('Widget_Options')->headerniu)){
					$json = '['.Typecho_Widget::widget('Widget_Options')->headerniu.']';
					$headerniu = json_decode($json);
					$headerniuOutput = "";
					foreach ($headerniu as $headerni){
						@$itemName = $headerni->name;
						@$itemlink = $headerni->link;
					
						$headerniuOutput .= '<li class="nav__item"><a href="'.$itemlink.'">'.$itemName.'</a></li>';
					}
				}
				?>
				<?php if (!$hideHomeItem): ?>
				<!--主页-->
				<?php endif; ?>
				<?php echo @$headerniuOutput ?>
                                <!-- {"name":"名称","link":"/6.html"} -->
                            </ul>
						</div>
                    </div>
					    
