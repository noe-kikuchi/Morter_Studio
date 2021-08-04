<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <script src="validate-config.js"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
<?php
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->login_user();
  // echo $user['role'];
?>

<?php
      // session_start();
      echo $_SESSION['EMAIL'];
      //ログイン済みの場合
      try {        
        // データベースに接続
        $dsn = 'mysql:dbname=morterstudio;host=localhost';
        $user = 'root';
        $pass = 'root';      
        $pdo = new PDO($dsn, $user, $pass);
        if ($pdo == null){
          print('接続に失敗しました。<br>');
        }else{
          // print('接続に成功しました。<br>');
        }
          $pdo->query('SET NAMES utf8'); 
      } catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
      } 

      $stmt = $pdo->prepare('SELECT email, role FROM user WHERE email = :email');  
      $stmt->execute(array(':email' => $_SESSION['EMAIL']));
      $result = 0;
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo $result['role'];

?>
      
<?php if($result['role'] != 0):?>
        <script type='text/javascript'>location.href = './top.php'</script>

<?php endif; ?>

  <script>
      if(confirm("No.<?= $_GET['id']; ?>を削除してもよろしいですか？") == false ) {
        // キャンセルならアラートボックスを表示
        alert("削除しませんでした。");
        window.location.href = "./top.php";
      }else {
        // OKなら移動
        location.href = './delete_confirm.php?id=<?= $_GET['id']; ?>';
      }
  </script>



</body>
</html>