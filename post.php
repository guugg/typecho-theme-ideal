<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<?php if($this->category == "allimg"): ?>
    <div id="pjax-container">
        <div class="pb-2">
        <h1 class="title title--h1 title__separate">相册分类</h1>
        </div>
    <div class="pb-0">
         <div class="gallery-grid js-masonry js-filter-container">
			<div class="gutter-sizer"></div>
                
        <?php
            $imgs = getAttachImg($this->cid);
            foreach($imgs as $img) {
            echo "
            <figure class=\"gallery-grid__item\">
            <div class=\"gallery-grid__image-wrap\">
            <img src=\"$img[1]\" title=\"$img[0]\" class=\"gallery-grid__image cover medium-zoom-image ls-is-cached lazyloaded\" data-zoom alt=\"\" >
            </div>
            </figure>
            ";
            }
        ?>
         </div>
    </div>
        
    </div> 

</div>
					
<?php $this->need('footer.php'); ?>

<?php else: ?> 

    <div id="pjax-container">
        <div class="pb-3">
            <header class="header-post">
                <div class="header-post__date">分类:<?php $this->category(','); ?>   -  更新日期:<?php $this->date(); ?></div>
                <h1 class="title title--h1"><?php $this->title() ?></h1>
                <div class="header-post__image-wrap">
                    <?php if ($this->is('category', 'default')) : ?>
                    如果是文章页面就会显示这里的文字
                    <?php endif; ?>
                    <img class="cover lazyload" src="<?php showThumbnail($this); ?>" alt="" />
                </div>
            </header>
            <div class="caption-post">
                <?php $this->content(); ?>
            </div>

            <footer class="footer-post">
                    <span class="color--light">
                标签：<div><?php $this->tags('</div><div>', true, 'none'); ?></div>
                    </span>
            </footer>
        </div>
        <?php $this->need('comments.php'); ?>
    </div> 

</div>
					
<?php $this->need('footer.php'); ?>
<?php endif; ?>

