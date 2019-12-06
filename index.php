<?php
/**
 * 这是根据 Typecho 默认主题，制作的一个ideal简约主题。 你可以在<a href="https://803344.xyz">的网站</a>获得更多关于此皮肤的信息
 * 
 * @package Typecho ideal Theme 
 * @author 小宇宙
 * @version 1.0
 * @link https://803344.xyz
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');    //调用head头部
 ?>

	<div class="pb-2">
		<h1 class="title title--h1 title__separate">博客</h1>
	</div>

			<div id="pjax-container"><!-- 局部刷新-->
			<div class="news-grid pb-0">
			<?php if ($this->have()): ?>
			<?php while($this->next()): ?>
				<article class="news-item box">
					<div class="news-item__image-wrap overlay overlay--45">
						<!-- 发布时间/标签 -->
						<div class="news-item__date"><?php $this->date(); ?></div>
						<!-- 文章链接 -->
						<a class="news-item__link" href="<?php $this->permalink() ?>"></a>
						<!-- 文章缩略图 -->
						<img class="cover lazyload" src="<?php showThumbnail($this); ?>" alt="" />
					</div>
					<div class="news-item__caption">
						<!-- 文章标题 -->
						<h2 class="title title--h4"><?php $this->title() ?></h2>
						<!-- 文章摘要 -->
						<p><?php $this->excerpt(40, '...'); ?></p>
					</div>
				</article>
		<?php endwhile; ?>




		<?php else: ?>暂无文章<?php endif; ?>
			</div>

		<div id="nimawu" style="padding: 1.875rem;">
		<?php $this->pageNav('«', '»', 3, '...', array(
			'wrapTag' => 'ol', 'wrapClass' => 'pagination justify-content-center', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '',)); ?>
		</div>
 		</div>

			</div>
		

					
	 <!-- 调用footer底部加载 -->
<?php $this->need('footer.php'); ?>