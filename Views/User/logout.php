<?php
session_start();
$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊
?>

<p>ログアウトしました。</p>
<a href="top.php">トップへ</a>
<script type='text/javascript'>location.href = 'top.php'</script>
