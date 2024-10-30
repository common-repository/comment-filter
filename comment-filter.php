<?php
/*
Plugin Name: Comment Filter
Plugin URI: http://www.williamlong.info/archives/1073.html
Description: Comment Filter is a plugin that allows for filtering of bad words used during commenting.
Version: 1.0.0
Author: William Long, Whoo
Author URI: http://www.williamlong.info
License: GPL2
Text Domain: comment-filter
*/

function profanity_comment_filter($content) {

// 使用这个插件可以将评论中敏感关键字（也就是传说中的“有害信息”）进行过滤（分隔符|），将敏感文字替换为×。
// 修改下面一行的内容，增加你需要的过滤关键字，关键字之间使用分隔符|进行分割。
$banned_contents = "fuck|shit|中共|共产|共党|社会主义|民主|人权|毛泽东|马列主义|中国政府|中央政府|游行示威|天安门|你妈|他妈|我操|tmd";

$patterns = explode("|", $banned_contents);
$finalremove=$content;
$piece_front="";
$piece_back="";
$piece_replace="****";

    for ($x=0; $x < count($patterns); $x++) {

    $safety=0;

        while(strstr(strtolower($finalremove),strtolower($patterns[$x]))) {
        # find & remove all occurrence
       
        $safety=$safety+1;
        if ($safety >= 100000) { break; }

        $occ=strpos(strtolower($finalremove),strtolower($patterns[$x]));
        $piece_front=substr($finalremove,0,$occ);
        $piece_back=substr($finalremove,($occ+strlen($patterns[$x])));
        $finalremove=$piece_front . $piece_replace . $piece_back;
        } # while
       
    }
	return $finalremove;
}
add_filter('comment_text','profanity_comment_filter');
?>