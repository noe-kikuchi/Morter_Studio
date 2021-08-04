<!-- 登録完了 -->

<!-- <?php echo $_POST['password'] ?> -->
<?php 
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->sign_in();
?>

<script type='text/javascript'>location.href = 'login_form.php'</script>



