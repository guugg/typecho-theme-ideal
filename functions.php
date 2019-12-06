<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;


require_once("libs/I18n.php");
require_once("libs/Handsome.php");

function themeConfig($form) {
    $logotu = new Typecho_Widget_Helper_Form_Element_Text('logotu', NULL, 'http://127.0.0.1/usr/themes/ideal/rand/6.jpg', _t('左侧栏 头像'), _t('在这里填入一个图片 URL 地址, 以在网站左侧栏前加上一个 头像'));
    $form->addInput($logotu);
    $mingcheng = new Typecho_Widget_Helper_Form_Element_Text('mingcheng', NULL, 'ideal', _t('左侧栏 名称'), _t('在这里输入你的名称,显示在左侧栏。可以html写法：<span class="weight--500">Felecia</span> Brown'));
    $form->addInput($mingcheng);
    $miaoshu = new Typecho_Widget_Helper_Form_Element_Text('miaoshu', NULL, '白嫖学生', _t('左侧栏 座右铭'), _t('输入一个职业名；'));
    $form->addInput($miaoshu);
    
    $noticer = new Typecho_Widget_Helper_Form_Element_Textarea('noticer', NULL, '<a class="social__link" href="https://803344.xyz/"><i class="font-icon icon-facebook"></i></a><a class="social__link" href="https://803344.xyz/"><i class="font-icon icon-twitter"></i></a><a class="social__link" href="https://803344.xyz/"><i class="font-icon icon-linkedin2"></i></a>', _t('左侧栏三图标'), _t('为什么不使用json了？将来会继续美化下，现在留着是方便给部分做个小广告。'));
$form->addInput($noticer);

    $sidebarniu = new Typecho_Widget_Helper_Form_Element_Textarea('sidebarniu', NULL, '{"name":"首页","ico":"font-icon icon-calendar","link":"/"}', _t('左栏目导航'), _t('使用JSON格式书写按钮组,查询文档说明！'));
$form->addInput($sidebarniu);


    $zuocustom = new Typecho_Widget_Helper_Form_Element_Textarea('zuocustom', NULL, '{"name":"下载","ico":"font-icon icon-download","link":"https://803344.xyz/","aclass":"btn btn--blue-gradient","dclas":"my-2"}', _t('左栏目自定义'), _t('使用JSON格式书写按钮组,查询文档说明！'));
$form->addInput($zuocustom);


    $headerniu = new Typecho_Widget_Helper_Form_Element_Textarea('headerniu', NULL, '{"name":"名称","link":"https://803344.xyz/"}', _t('右上角按钮'), _t('暂时支持自定义按钮'));
$form->addInput($headerniu);
}

// 文章缩略图header
function showThumbnail($widget)
{ 
    // 当文章无图片时的随机缩略图
    $rand = rand(1,9); // 随机 1-9 张缩略图
    $random = $widget->widget('Widget_Options')->themeUrl . '/rand/' . $rand . '.jpg'; // 随机缩略图路径
    $attach = $widget->attachments(1)->attachment;
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i'; 
if (preg_match_all($pattern, $widget->content, $thumbUrl)) {
         echo $thumbUrl[1][0];
    } else     if ($attach->isImage) {
      echo $attach->url; 
    } else {
        echo $random;
    }
}


function themeFields($layout) {
    $Pictype= new Typecho_Widget_Helper_Form_Element_Radio('Pictype',array('0' => _t('概念'),'1' => _t('设计'),'2' => _t('生活')),'2',_t('图片分类'),_t("选择图片的分类,将在相册切换的时候无刷新,不选择分类则直接在图片首页"));
    $layout->addItem($Pictype);
}
 

//获取附件图片
function getAttachImg($cid) {
    $db = Typecho_Db::get();
    $rs = $db->fetchAll($db->select('table.contents.text')
            ->from('table.contents')
            ->where('table.contents.parent=?', $cid)
            ->order('table.contents.cid', Typecho_Db::SORT_ASC));
    $attachPath = array();
    foreach($rs as $attach) {
        $attach = unserialize($attach['text']);
        if($attach['mime'] == 'image/jpeg'||$attach['mime'] == 'image/png'||$attach['mime'] == 'image/gif') {
            $attachPath[] = array($attach['name'], $attach['path']);
        }
    }
    return $attachPath;
}


