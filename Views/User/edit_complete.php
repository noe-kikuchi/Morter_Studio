完了

<?php 

// echo $_POST['id'];
// echo $_POST['name'];


  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->user_edit();

?>

<script type='text/javascript'>location.href = 'top.php'</script>
