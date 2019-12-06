<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');    //调用head头部
 ?>

	<div class="pb-2">
		<h1 class="title title--h1 title__separate">通用列表页</h1>
	</div>
			<!-- 内容 -->
			<div id="pjax-container"><!-- 局部刷新-->
			<div class="news-grid pb-0">
			<?php if ($this->have()): ?>
			<?php while($this->next()): ?>
				<article class="news-item box">
					<div class="news-item__image-wrap overlay overlay--45">
						<div class="news-item__date"><?php $this->date(); ?></div>
						<a class="news-item__link" href="<?php $this->permalink() ?>"></a>
						<img class="cover lazyload" src="<?php showThumbnail($this); ?>" alt="" />
					</div>
					<div class="news-item__caption">
						<h2 class="title title--h4"><?php $this->title() ?></h2>
						<p><?php $this->excerpt(40, '...'); ?></p>
					</div>
				</article>
		<?php endwhile; ?>
		<?php else: ?>暂无文章<?php endif; ?>
			</div>
			<!-- 文章分页 -->
			<div id="nimawu" style="padding: 1.875rem;">
				<?php $this->pageNav('«', '»', 3, '...', array(
					'wrapTag' => 'ol', 'wrapClass' => 'pagination justify-content-center', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '',)); ?>
			</div>
			</div>
		</div>

	 <!-- 调用footer底部加载 -->
<?php $this->need('footer.php'); ?>