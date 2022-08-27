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

$result = $post->getAllPosts();

$row_count = $result->rowCount();

if ($row_count > 0) {

    //create array to store results in key value for additional things like pagination
    $post_array = array();
    $post_array['data'] = array();

    while ($row = $result->fetch()) {
        extract($row);
        $item = array(
            'id' => $id,
            'category_id' => $category_id,
            'title' => $title,
            'body' => $body,
            'name' => $name,
            'created_at' => $created_at,
        );

        array_push($post_array['data'],$item);
    }
    echo json_encode($post_array);
}
else{
    echo json_encode(array('message' => 'Not Posts Found'));
}

