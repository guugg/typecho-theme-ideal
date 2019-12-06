<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<aside class="col-12 col-md-12 col-xl-3">
	<div class="sidebar box pb-0 sticky-column">
		<svg class="avatar avatar--180" viewBox="0 0 188 188">
			<g class="avatar__box">
				<image xlink:href="<?php $this->options->logotu() ?>" height="100%" width="100%" />
			</g>
		</svg>
		<div class="text-center">
			<h3 class="title title--h3 sidebar__user-name"><span class="weight--500"><?php if ($this->options->mingcheng())?> </h3>
			<div class="badge badge--gray">
				<?php 
				if ($this->options->miaoshu())?>
			</div>
			
			<div class="social">
				<div class="notice" itemprop="description">
					<?php $this->options->noticer(); ?>
				</div>
		</div>
		</div>
		<div class="sidebar__info box-inner box-inner--rounded">
			<ul class="contacts-block">
				<?php
				$hideHomeItem = false;
				if(!empty(Typecho_Widget::widget('Widget_Options')->sidebarniu)){
					$json = '['.Typecho_Widget::widget('Widget_Options')->sidebarniu.']';
					$sidebarniu = json_decode($json);
					$sidebarniuOutput = "";
					foreach ($sidebarniu as $sidebarni){
						@$itemName = $sidebarni->name;
						@$itemico = $sidebarni->ico;
						@$itemlink = $sidebarni->link;
						@$itemtip = $sidebarni->tip;
						@$itemdir = $sidebarni->dir;
					
						$sidebarniuOutput .= '<li class="contacts-block__item" data-toggle="tooltip" data-placement="'.$itemdir.'" title="'.$itemtip.'"><a href="'.$itemlink.'"><i class="'.$itemico.'"></i><span>'.$itemName.'</span></a></li>';
					}
				}
				?>
				<?php if (!$hideHomeItem): ?>
				<?php endif; ?>
				<?php echo @$sidebarniuOutput ?>
			</ul>
			<?php
				$hideHomeItem = false;
				if(!empty(Typecho_Widget::widget('Widget_Options')->zuocustom)){
					$json = '['.Typecho_Widget::widget('Widget_Options')->zuocustom.']';
					$zuocustom = json_decode($json);
					$zuocustomOutput = "";
					foreach ($zuocustom as $zuocusto){
						@$itemName = $zuocusto->name;
						@$itemico = $zuocusto->ico;
						@$itemlink = $zuocusto->link;
						@$itemaclass = $zuocusto->aclass;
						@$itemdclas = $zuocusto->dclas;
					
						$zuocustomOutput .= '<div class="'.$itemdclas.'"> <button type="button" class="'.$itemaclass.'" onclick="window.open('.$itemlink.')"><i class="'.$itemico.'"></i><small>'.$itemName.'</small></button> </div>';
					}
				}
				?>
				<?php if (!$hideHomeItem): ?>
				<?php endif; ?>
				<?php echo @$zuocustomOutput ?>
		</div>
	</div>	
</aside>
