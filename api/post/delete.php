<?php
    
    header('Access-Control-Allow-Origin: *');
    header('content-type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers Content-Type,Access-Control-Allow-Methods,X-Requested-With,Authorization');

    include_once ('../../db/Database.php');
    include_once ('../../models/Post.php');


    $database = new Database();
    $db = $database->connect();
    $post = new Post($db);
    $post->id = isset($_GET['id']) ? $_GET['id'] : die() ;

    if($post->deletePost()){
        echo json_encode(array(
            'message' => 'Deleted successfully'
        ));
    }
    else{
        echo json_encode(array(
            'message' => 'Failed To Delete'
        ));
    }

?>