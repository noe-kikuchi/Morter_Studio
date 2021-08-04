<!DOCTYPE html>
<html>
<head>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/index.css">
  <!-- <script src="validate-config.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
</head>
<body>


<?php
  // session_start();
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->my_show();
  // echo $user['role'];
  foreach((array)$params as $user){
    // echo  $user['id'];
    $current_user = $user['id'];
  }
  // echo $current_user;
  // echo $_GET['id'];
  $user_id = $current_user;
  $bike_id = $_GET['id'];

?>


<?php
function check_favolite_duplicate($user_id,$bike_id){
  $dsn = 'mysql:dbname=morterstudio;host=localhost';
  $user='root';
  $password='root';
  $dbh=new PDO($dsn,$user,$password);
    $sql = "SELECT *
            FROM likes
            WHERE user_id = :user_id AND bike_id = :bike_id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id ,
                         ':bike_id' => $bike_id));
    $favorite = $stmt->fetch();
    return $favorite;
}
?>



<form>
<button id="l1" type="button" class="iine">
<?php if (!check_favolite_duplicate($user_id,$bike_id)): ?>
          いいね
        <?php else: ?>
          いいね済
        <?php endif; ?>
</button>
<input type="hidden" value="<?=$_GET['id']?>" name="bike_id">
<!-- <input type="text" value="<?=$user_id?>" name="user_id"> -->
</form>



<script>
  $(function(){
$('.iine').on('click',function () {
  console.log('ok');
  var elem = document.getElementById("l1");
    // 新しいHTML要素を作成
    elem.innerHTML = "<span>いいね済<" + "/span>";  
// $(this).css('background','#ff6060');
List= $(this).attr('id').replace("l", "");
$.post("../Like/iine.php?",{'list':List,'bike_id':'<?=$_GET['id']?>'});
});
});

// function calliine() {
//     console.log('ok');
//   var elem = document.getElementById("l1");
//     // 新しいHTML要素を作成
//     elem.innerHTML = "<span>♡いいね済<" + "/span>";  
// // $(this).css('background','#ff6060');
// List= $(this).attr('id').replace("l", "");
// $.post("../Like/iine.php?",{'bike_id':'<?=$_GET['id']?>'});
// }

</script>



</body>
</html>