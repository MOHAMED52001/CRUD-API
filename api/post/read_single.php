<?php 
header('Access-Control-Allow-Origin: *');
header('content-type: application/json');
include_once ('../../db/Database.php');
include_once ('../../models/Post.php');


//instantiating the database obj
$database = new Database();
$db = $database->Connect();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//instantiating the post obj

$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die() ;

$post->getSinglePost(); 

$post_arr = array(
    'id' => $post->id,
    'category_id' => $post->category_id,
    'title' => $post->title,
    'body' => $post->body,
    'name' => $post->name,
    'created_at' => $post->created_at
);

if(!empty($post_arr)){
    echo json_encode($post_arr);
}
else{
    echo json_encode(array(
        'message' => 'No post found',
    ));
}   