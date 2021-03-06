<?php
require '../../../../wp-blog-header.php';
global $wpdb;
$user_id = $_COOKIE['user_id'];
$wpdb->query("SELECT * from $wpdb->posts");
$posts_id = base_convert(uniqid(), 32, 10);
$now_date = date('Y-m-d H:i:s');
$APost = array(
    "ID" => $posts_id,
    "post_author" => $user_id,
    "post_date" => $now_date,
    "post_date_gmt" => $now_date,
    "post_content" => stripslashes($_POST["test-editormd-html-code"]) ,
    "post_excerpt" => $_POST["post_excerpt"],
    "post_title" => $_POST["post_title"],
    "post_status" => "publish",
    "comment_status" => "open",
    "post_modified" => $now_date,
    "post_modified_gmt" => $now_date,
    "guid" => get_bloginfo('url') . "?p=" . "$posts_id",
    "post_type" => "post",
    "post_name" => md5($now_date . $_POST["post_title"])
);
$wpdb->insert($wpdb->posts, $APost);
add_post_meta($posts_id, 'articleMd', htmlentities($_POST["test-editormd-markdown-doc"]));
header('location:../mineblog.php');