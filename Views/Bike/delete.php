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

<?php foreach((array)$params as $user): ?>
    <?php 
    echo $user['id'];
    $login_user = $user['id'];
    // if($user['id']==$bike['user_id']){
    //   echo '<a href=../Bike/upload_edit.php?id='. $bike['id']. '>編集</a>'; 
    // }
    ?>

    <!-- // ゲットIDをからバイク情報のUser＿idを取得し一致したときに削除できるようにする -->
    <?php echo $_GET['id']; ?>
    

    <!-- <?php if($result['role'] != 0):?> -->
            <!-- <script type='text/javascript'>location.href = './index.php'</script> -->

    <!-- <?php endif; ?> -->


    <?php
      require_once(ROOT_PATH .'Controllers/BikeController.php');
      $user = new BikeController();
      $params = $user->bike__show();
      // echo $user['role'];
    ?>

    <?php foreach((array)$params as $bike): ?>
      <?=$bike['user_id'] ?>
      <?php $user_id = $bike['user_id'] ?>

      <?php if($login_user != $user_id):?>
        <script type='text/javascript'>location.href = '../User/top.php'</script>
      <?php endif; ?>

      <script>
        if(confirm("<?= $bike['title']; ?>を削除してもよろしいですか？") == false ) {
          // キャンセルならアラートボックスを表示
          alert("削除しませんでした。");
          window.location.href = '../User/top.php';
        }else {
          // OKなら移動
          location.href = './delete_confirm.php?id=<?= $_GET['id']; ?>';
        }
      </script>

    <?php endforeach; ?>




<?php endforeach; ?>


<a href="javascript:history.back();">戻　る</button></a>



</body>
</html>

