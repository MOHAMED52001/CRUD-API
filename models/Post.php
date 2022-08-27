<?php

class Post
{
    //DB props
    private $conn;
    private $table = 'posts';

    //Table Coulumns
    public $id;
    public $category_id;
    public $title;
    public $body;
    public $name;
    public $created_at;

    //Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get All Posts
    public function getAllPosts()
    {
        //Query
        $sql = "SELECT 
                c.name AS Category_Name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.name,
                p.created_at FROM posts p 
                LEFT JOIN  
                category c on c.id = p.category_id
                
                ";
        //Prepare Statement
        $stmt = $this->conn->prepare($sql);
        //Execute statement
        $stmt->execute();

        return $stmt;
    }

    public function getSinglePost()
    {

        //Query
        $sql = "SELECT 
                c.name AS Category_Name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.name,
                p.created_at FROM posts p 
                LEFT JOIN  
                category c on c.id = p.category_id
                WHERE p.id = ?
                
                ";
        //Prepare Statement
        $stmt = $this->conn->prepare($sql);
        //bind id
        $stmt->bindParam(1, $this->id);
        //Execute statement
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->category_id = $row['category_id'];
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->name = $row['name'];
        $this->created_at = $row['created_at'];
    }

    public function createPost()
    {
        //Query
        $sql = 'INSERT INTO posts(category_id, title,body,name) VALUES(:category_id, :title, :body, :name)';
        //Prepare statement
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':name', $this->name);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s\n", $stmt->error);
        return false;
    }

    public function updatePost()
    {
        //Query
        $sql = "UPDATE  posts
        SET 
        category_id = :category_id,
        title = :title,
        body = :body,
        name = :name
        WHERE id = :id
        ";

        //prepare statement
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s\n", $stmt->error);
        return false;
    }

    public function deletePost(){
        //Query
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s\n", $stmt->error);
        return false;
    }

}
