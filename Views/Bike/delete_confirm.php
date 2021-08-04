<?php echo $_GET['id']; ?>


<?php
  require_once(ROOT_PATH .'Controllers/BikeController.php');
  $user = new BikeController();
  $params = $user->bike_delete();
  // echo $user['role'];
?>

<script type='text/javascript'>location.href = '../User/top.php'</script>
