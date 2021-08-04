
<?php

require_once('../Controllers/UserController.php');
$user = new UserController();
$params = $user->log_in();
?>

<script type='text/javascript'>location.href = 'top.php'</script>
