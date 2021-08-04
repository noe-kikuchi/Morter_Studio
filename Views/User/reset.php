<?php 
echo $_POST['email'];
require_once(ROOT_PATH .'Controllers/UserController.php');
$user = new UserController();
$params = $user->reset_select()
?>
<?php if(empty($_POST['email'])):?>
    <!-- 空白の場合のバリデーション -->
    <script type='text/javascript'>
      alert('メールアドレスを入力してください');
    </script>
    <script type='text/javascript'>location.href = '<?=$_SERVER['HTTP_REFERER']?>'</script>

<?php else: ?>
  <?php foreach((array)$params as $user): ?>
    <!-- 該当なしの時の処理 -->
    <?php if(empty($user['email'])): ?>
      <script type='text/javascript'>
        alert('入力されたメールアドレスの登録がありません');
      </script>
      <script type='text/javascript'>location.href = '<?=$_SERVER['HTTP_REFERER']?>'</script>
    <?php else: ?>
    <!-- 該当ありの時の処理 -->
      
      <?= $user['email'] ?>

      <!-- <?php $passResetToken = md5(uniqid(rand(),true)); ?> -->
      <!-- <?php $now = date("Y/m/d H:i:s"); ?> -->
      <?php echo $now; ?>

      <?php
      require_once(ROOT_PATH .'Controllers/UserController.php');
      $user = new UserController();
      $params = $user->token_save()
      ?>

      <?php
        require_once(ROOT_PATH .'Controllers/UserController.php');
        $user = new UserController();
        $params = $user->token_mail()
      ?>
      <?php foreach((array)$params as $user): ?>
        <?php $passResetToken = $user['pass_reset_token'];?>
      <?php endforeach; ?>

      
      <?php
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $to = $_POST['email'];
        $title = 'パスワードリセット';
        $message = 'URLから再登録してください。' . 'http://localhost/User/pass_reset_form.php?pass_reset_token=' . $passResetToken;
        $header = 'From:' . $_POST['email'];
        // $header = "MIME-Version: 1.0\r\n"
        // . "Content-Transfer-Encoding: 7bit\r\n"
        // . "Content-Type: text/plain; charset=ISO-2022-JP\r\n"
        // . "Message-Id: <" . md5(uniqid(microtime())) . "@ドメイン>\r\n"
        // . "From:" . $title . $_POST['email'] . "\r\n";
        // mb_send_mail($to, $title, $message, mb_encode_mimeheader($header), '-f' . $_POST['email'])
        // mb_send_mail($to, $title, $message, $header, '-f' . $_POST['email'])
      ?>  
      <?php if(mb_send_mail($to, $title, $message, $header, '-f' . $_POST['email'])): ?>
          <p>メールを送信しました</p>
          <script type='text/javascript'>location.href = 'mail_ok.php'</script>
      <?php else: ?>
          <p>メールの送信に失敗しました</p>
      <?php endif;?>

      
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif;?>

