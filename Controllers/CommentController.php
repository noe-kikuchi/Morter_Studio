<?php
require_once(ROOT_PATH .'/Models/Comment.php');

class CommentController{
  private $Comment;

  public function __construct(){
    $this->Comment = new Comment();
  }

  public function index(){
    $params = ['test' => 'index'];
    return $params;
  }

}



?>