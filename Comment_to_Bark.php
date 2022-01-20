<?php
/**
 * WordPress Bark 推送评论通知
 * Comment to Bark for WordPress
 * 作者bbis
 * 版本1.0
 * 博客 https://cheen.cn
 * 
 * $comment	    	评论结构
 * $post_name		被评论的文章
 * $bark_key		bark token
 * $bark_icon		bark 推送图标
 * $bark_group		bark 群组
 * $bark_goto_url	bark 文章链接
 * $bark_sound		bark 推送声音
 * $bark_archive	bark 保存信息	1-启用 0-停用 启用后客户端自动保存推送信息
 * $isMyself		检测作者ID      1-启用 0-停用 启用后当评论者为 $customName 时不通知 
 * $customName		作者评论ID      如果此值为空，则停用检测
 * 
 **/

function bark_push_msg($comment, $post_name)
{
		$bark = "https://api.day.app/";
        $bark_key = "********";
        $bark_icon = "";
        $bark_group = "Blog";
 		$bark_goto_url = get_permalink( $comment->comment_post_ID );
 		$bark_sound = "gotosleep";
        $bark_archive = "1";
        $isMyself = "1";
		$customName = "admin";

        if($isMyself == '1') {
            if (!empty($customName)) {
                if ($comment->comment_author == $customName) {
                    return $comment;
                }
            } elseif ($comment->comment_author == 1) {
                return  $comment;
            }
        }
        
        $title = "博客收到了新的评论";
        $message = $comment->comment_author . "在『 $post_name 』评论：\n" . $comment->comment_content;

        $postdata = array(
            'title' => $title,
            'body' => $message
        );

        !empty($bark_icon) ? $postdata["icon"] = $bark_icon : "";
        !empty($bark_group) ? $postdata["group"] = $bark_group : "";
        !empty($bark_archive) ? $postdata["isArchive"] = $bark_archive : "";
        !empty($bark_sound) ? $postdata["sound"] = $bark_sound : "";        
		!empty($bark_goto_url) ? $postdata["url"] = $bark_goto_url : "";

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($postdata)
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false
            )
        );

        $context  = stream_context_create($opts);
        $result = file_get_contents($bark.$bark_key, false, $context);
        return  $comment;
}

add_action('comment_post', 'comment_bark_notify');
function comment_bark_notify($comment_id) 
{
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
	bark_push_msg($comment, get_the_title($comment->comment_post_ID));
}
