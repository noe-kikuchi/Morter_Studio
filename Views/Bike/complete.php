
<?php
// $ok_alert = "<script type='text/javascript'>alert('No.".$_POST["id"]."の更新内容\\n背番号:".$_POST["uniform_num"]."\\nポジション:".$_POST["position"]."\\n名前:".$_POST["name"]."\\n所属:".$_POST["club"]."\\n誕生日:".$_POST["birth"]."\\n身長:".$_POST["height"]."\\n体重:".$_POST["weight"]."\\n国:".$_POST["country_name"]."');</script>";
    $ok_alert = "<script type='text/javascript'>window.confirm('登録しました');</script>";
  
  // 使用する変数を初期化
  $title = '';
  $model = '';
  $model_year = '';
  $manufacturer = '';
  $custom = '';
  $url = '';
  $image = '';
  $introduction = '';

  // エラー内容
  $errors = [];

  // 送信データをチェック
  if (isset($_POST)) {
    if (empty($_POST['title'])) {
      $errors[] = 'タイトルは必須項目です。\\n';
    }
    if (empty($_POST['model'])) {
      $errors[] = '車種は必須項目です。\\n';
    }
    if (empty($_POST['manufacturer'])) {
      $errors[] = 'メーカーは必須項目です。\\n';
    }
    if (empty($_POST['custom'])) {
      $errors[] = 'カスタムは必須項目です。\\n';
    }
    if (empty($_FILES['image']['tmp_name'])) {
      $errors[] = '画像は必須項目です。\\n';
    }
    if (empty($_POST['introduction'])) {
      $errors[] = '説明文は必須項目です。\\n';
    }

  }
?>


<?php if (empty($errors)): ?>
    <?php echo $ok_alert; ?>

    <?php
      require_once(ROOT_PATH .'Controllers/BikeController.php');
      $bike = new BikeController();
      $params = $bike->save();
    ?>

    <script type='text/javascript'>location.href = '../User/top.php'</script>

<?php else : ?>
  <script type='text/javascript'>
    alert('エラー\n<?php foreach ($errors as $msg): ?><?php echo $msg; ?><?php endforeach;?>');
    window.location.href = history.back();;
  </script>  

<?php endif;?> 





