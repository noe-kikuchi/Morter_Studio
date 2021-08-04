<?php

echo $_GET['id'];


  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->delete();
  // echo $user['role'];

?>

<script type='text/javascript'>location.href = './top.php';</script>

