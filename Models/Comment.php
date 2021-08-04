<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Comment extends Db {
  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }
    
}

?>