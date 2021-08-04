<?php
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->login_user();
  // echo $user['role'];
?>

<!-- <?php echo $_GET['id']; ?> -->


<?php foreach((array)$params as $user): ?>
    <?php 
    echo $user['id'];
    $user_id = $user['id'];
    ?>
<?php endforeach; ?>

<?php
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
   //拡張子判別
   $mimetype  = mime_content_type($_FILES['upfile']['tmp_name']);
   $extension = array_search($mimetype, [
       'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif',
   ]);

   if (false !== $extension) {
       $upfile = 'photo.'.$extension;  //固定アップロードファイル名（拡張子自動補完）
       $uppath = 'files/'.$upfile;

       //アップロードファイル移動、上書き
       if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $uppath)) {
           chmod($uppath, 0644);
           echo $upfile . "をアップロードしました。";
       } else {
           echo "ファイルをアップロードできません。";
       }
   } else {
       echo $mimetype.'のファイル形式はアップロードできません。JPEG・PNG・GIFの画像のみアップロードできます。';
   }
} else {
 echo "ファイルが選択されていません。";
}?>




