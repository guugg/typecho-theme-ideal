<?php function threadedComments($comments, $options) {
    // 动态控制结构
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    } 
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-box';  //评论层数大于0为子级，否则是父级
?>
      <!-- ... //html 固定结构 -->
<div id="li-<?php $comments->theId(); ?>" class="comment-box<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-box';
}
$comments->alt(' comment-box', ' comment-even');
echo $commentClass;
?>">
 <div class="comment-box__inner" id="<?php $comments->theId(); ?>">
    <div class="avatar avatar--60" viewBox="0 0 84 84">
        <!-- QQ头像 -->
            <span itemprop="image"><?php $number=$comments->mail; echo '<img src="https://q2.qlogo.cn/headimg_dl? bs='.$number.'&dst_uin='.$number.'&dst_uin='.$number.'&;dst_uin='.$number.'&spec=100&url_enc=0&referer=bu_interface&term_type=PC" width="46px" height="46px" style="border-radius: 50%;">'; ?></span>
    </div>
        <div class="comment-box__body">
            <h5 class="comment-box__details">
                <!-- 评论者名字 -->
                <span><?php $comments->author(); ?></span>
                <!-- 评论时间 -->
                <span class="comment-box__details-date" ><?php $comments->date('F jS, Y \a\t h:i a'); ?></span>
            </h5>
            <?php $comments->content(); ?>
            <?php if ('waiting' == $comments->status) { ?>  
            <em class="awaiting"><?php $options->commentStatus(); ?></em>  
            <?php } ?>
            <!-- 回复按钮 -->
            <ul class="comment-box__footer">
                <li>
                    <span><?php $comments->reply('<i class="font-icon icon-reply"></i>回复'); ?></span>
                </li>
            </ul>
        </div>
 </div>
<?php if ($comments->children) { ?>    <!--//是否嵌套评论判断开始-->
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>     <!--嵌套评论所有内容 -->
    </div>
<?php } ?>
</div>
<?php } ?><!--}是函数的结束符-->



<!-- 使用div包住列表与输入框 -->
<div class="box-inner box-inner--rounded">     <!--这里删除了id="comments"看下不显示是不是这里的问题-->
<!-- 输出评论列表 -->
    <?php $this->comments()->to($comments); ?>
    <!--如果有评论的才会输出-->
    <?php if ($comments->have()): ?>
    <!--显示评论总条数-->
	<h3 class="title title--h3"><?php $this->commentsNum(_t('评论<span class="color--light">(%d)</span>')); ?></h3>
    
    <?php if ('waiting' == $comments->status) { ?><span class="text-muted">您的评论需管理员审核后才能显示！</span><?php } ?>
    <!-- 评论列表 -->

    <?php $comments->listComments(); ?>

        <!-- 评论翻页按钮 -->
    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>

<!-- 评论表单 -->
    <!-- 判断设置是否允许对当前文章进行评论 -->
<?php if($this->allow('comment')): ?>
 
    <h3 class="title title--h3"><?php $this->commentsNum(_t('评论<span class="color--light">(%d)</span>')); ?></h3>
 
    <!-- 输入表单开始 -->

        <ul class="social-auth">
            <li class="social-auth__item">登录:</li>
            <li class="social-auth__item"><a class="social-auth__link" href="#"><i class="font-icon icon-facebook"></i></a></li>
            <li class="social-auth__item"><a class="social-auth__link" href="#"><i class="font-icon icon-twitter"></i></a></li>
            <li class="social-auth__item"><a class="social-auth__link" href="#"><i class="font-icon icon-dribbble"></i></a></li>
            <li class="social-auth__item"><a class="social-auth__link" href="#"><i class="font-icon icon-behance"></i></a></li>
        </ul>    
    <form class="comment-form" method="post" action="<?php $this->commentUrl() ?>" id="comment_form">
 
        <!-- 如果当前用户已经登录 -->
        <?php if($this->user->hasLogin()): ?>
             <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
        <!-- 若当前用户未登录 -->
        <?php else: ?>
         <!-- 要求输入名字、邮箱、网址 -->
         <br>
        <input type="text" name="author" class="form-control" placeholder="名称" size="35" value="<?php $this->remember('author'); ?>" /><br>
        <input type="text" name="mail" class="form-control" placeholder="邮箱" size="35" value="<?php $this->remember('mail'); ?>" /><br>
        <input type="text" name="url" class="form-control" placeholder="网址" size="35" value="<?php $this->remember('url'); ?>" /><br>
        <?php endif; ?>
 
        <!-- 输入要回复的内容 -->
     <?php $comments->cancelReply('<i class="font-icon icon-reply"></i>取消'); ?>  <!-- 取消回复按钮 -->
     <textarea name="text" id="textarea" class="textarea textarea--white form-control" required="<?php $this->remember('text'); ?>" placeholder="你的评论一针见血..." rows="1">
        </textarea>
     <button type="submit" class="btn" style="top:auto;"><i class="font-icon icon-send"></i></button>
     <div class="dropdown dropup" style="top:auto;">
        <i class="font-icon icon-smile" id="dropdownEmoji" data-toggle="dropdown" aria-haspopup="true" style="font-size:2.2rem;"></i>
        <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownEmoji">
            <div class="emoji-wrap">
                <!-- <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-laughing.svg" title=":laughing:" alt="laughing" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-happy-2.svg" title=":happy 2:" alt="happy 2" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-crazy.svg" title=":crazy:" alt="crazy" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-bad.svg" title=":bad:" alt="bad" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-angry.svg" title=":angry:" alt="angry" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-happy.svg" title="happy" alt="happy" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-thinking.svg" title=":thinking:" alt="thinking" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-sad.svg" title=":sad:" alt="sad" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-pressure.svg" title=":pressure:" alt="pressure" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-in-love.svg" title=":in love:" alt="in love" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-nerd.svg" title=":laughing:" alt="nerd" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-happy-3.svg" title=":happy 3:" alt="happy 3" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-shocked.svg" title=":shocked:" alt="shocked" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-wink.svg" title=":wink:" alt="wink" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-sweating.svg" title=":sweating:" alt="sweating" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-shocked-2.svg" title=":shocked 2:" alt="shocked 2" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-shocked-3.svg" title=":shocked 3:" alt="shocked 3" />
                <img class="emoji" src="<?php $this->options->siteUrl(); ?>/usr/themes/ideal/assets/icons/emoji/emoji-sad-2.svg" title=":sad 2:" alt="sad 2" /> -->
                预留放SVG表情
            </div>
        </div>
    </div>
    <!-- 显示当前登录用户的用户名以及登出连接 -->
       
    </form>   

<?php endif; ?>



</div>
