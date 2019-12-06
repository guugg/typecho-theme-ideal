<?php
/**
 * 标签页
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
    <h1 class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
    <div class="post-content" itemprop="articleBody">
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); ?>
		<?php if($tags->have()): ?>
		<div class="post-tags<?php if($this->options->colorTags == 1): echo ' color-tags'; endif; ?>" style="zoom: 1.36;">
		<?php while ($tags->next()): ?>
			<a href="<?php $tags->permalink(); ?>" rel="tag" class="size-<?php $tags->split(5, 10, 20, 30); ?>" title="<?php $tags->count(); ?> 个话题"><?php $tags->name(); ?></a>
		<?php endwhile; ?>
		<?php else: ?>
			<?php _e('没有任何标签'); ?>
		<?php endif; ?>
		</div>
    </div>
</article>
<!-- end #main-->

<?php $this->need('footer.php'); ?>

