<?php
/**
 * 默认模板
 *
 * @package custom
 */


$json = '{"report":{"date":"2012-04-10","content":"abcdefght"}}';
 $arr = (array) json_decode($json,true);
 echo '当前日期是：'. $arr['report']['date'];
?>



<!-- <?php

   $json = '[ "$this->options->sidebarniu();"]';

   var_dump(json_decode($json));

   var_dump(json_decode($json, true));
?> -->


<!-- <?php 

// JSON编码的字符串

$json = '{"Coding_id": 85421545}'; 

   

// 使用json_decode（）函数对JSON字符串进行解码

$obj = json_decode($json); 

   

// 显示JSON对象的值

?>



<li class="<?php print $obj->{'Coding_id'}; ?>"> 123 </li>  -->