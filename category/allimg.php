<?php
/**
 * 自定义图片分类的样式
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<div class="pb-2">
        <h1 class="title title--h1 title__separate">相册分类</h1>
    </div>

    <!-- Gallery --> 
    <div class="pb-0">
        <!-- Filter -->
        <div class="select">
            <span class="placeholder">Select category</span>
            <ul class="filter">
                <li class="filter__item">Category</li>
                <li class="filter__item active" data-filter="*"><a class="filter__link active" href="#filter">全部</a></li>
                <li class="filter__item" data-filter=".category-concept"><a class="filter__link" href="#filter">概念</a></li>
                <li class="filter__item" data-filter=".category-design"><a class="filter__link" href="#filter">设计</a></li>
                <li class="filter__item" data-filter=".category-life"><a class="filter__link" href="#filter">生活</a></li>
            </ul>
            <input type="hidden" name="changemetoo"/>
        </div>

      <!-- Content -->
		<div class="gallery-grid js-masonry js-filter-container">
            <div class="gutter-sizer"></div>
            
			<?php if ($this->have()): ?>
			<?php while($this->next()): ?>
			<figure class="gallery-grid__item 
                <?php
                if ($this->fields->Pictype == 0)
                {
                    echo "category-concept";
                }
                elseif ($this->fields->Pictype == 1)
                {
                    echo "category-design";
                }
                else
                {
                    echo "category-life";
                }
                ?>
            ">

				<div class="gallery-grid__image-wrap">
                    <!-- 文章链接 -->
					<a class="news-item__link" href="<?php $this->permalink() ?>"></a>
					<!-- 文章缩略图 -->
					<img class="gallery-grid__image cover lazyload" src="<?php showThumbnail($this); ?>" data-zoom alt="" />
				</div>
				<figcaption class="gallery-grid__caption">
                    <!-- 文章标题 -->
                    <h4 class="title gallery-grid__title"><?php $this->title() ?></h4>
				</figcaption>
			</figure>
            <?php endwhile; ?>
          
            <?php else: ?>暂无文章<?php endif; ?>
        </div>
        <div id="nimawu" style="padding: 1.875rem;">
		<?php $this->pageNav('«', '»', 3, '...', array(
			'wrapTag' => 'ol', 'wrapClass' => 'pagination justify-content-center', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '',)); ?>
		</div>
    </div>
</div>
<!--换行-->

<?php $this->need('footer.php'); ?>

