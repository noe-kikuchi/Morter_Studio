<?php echo $_POST['id']; ?>
<?php echo $_POST['password']; ?>

<?php
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->pass_save()
?>

<script type='text/javascript'>location.href = 'login_form.php'</script>
