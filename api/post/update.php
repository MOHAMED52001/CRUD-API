<?php
    
    header('Access-Control-Allow-Origin: *');
    header('content-type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers Content-Type,Access-Control-Allow-Methods,X-Requested-With,Authorization');

    include_once ('../../db/Database.php');
    include_once ('../../models/Post.php');


    $database = new Database();
    $db = $database->connect();
    $post = new Post($db);
    $post->id = isset($_GET['id']) ? $_GET['id'] : die() ;
    $post->getSinglePost();

    $data = json_decode(file_get_contents('php://input'));

    $post->category_id = $data->category_id;
    $post->title = $data->title;
    $post->body = $data->body;
    $post->name = $data->name;


    if($post->updatePost()){
        echo json_encode(array(
            'message' => 'Updated successfully'
        ));
    }
    else{
        echo json_encode(array(
            'message' => 'Failed To Update'
        ));
    }

?>