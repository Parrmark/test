<!--<? session_start(); ?>-->

<?php

  require_once("./dbconfig.php");


  if(isset($_POST['ID'])){
    $ID = $_POST['ID'];
    $Password = $_POST['Password'];
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Board_free | Youngjin</title>
  </head>
  <body>
    <article>
    <div>
    <form id="loginValues" action="./index.php" method="post">

<?php

    //$sql = 'select count(password) as cnt from table_board where password=password("' . $Password . '") and id = ' . $ID;
    $sql = "select no from table_board where password=password('$Password') and id = " . "'$ID'";
?>
  <script>
    alert("<?php echo $sql?>");
  </script>
<?php
    $result = $db->query($sql);
    //$rowCount = $result->num_rows;

    $row = $result->fetch_assoc();

    $BackURL = './main.php';

    if(isset($row['no'])){
      $No = $row['no'];

?>
  <input type=hidden name="ID" value="<?=$ID?>">
  <input type=hidden name="Password" value="<?=$Password?>">
  <input type=hidden name="no" value="<?=$No?>">
  <script>
  	alert("<?php echo '로그인 성공'?>");
    alert("<?php echo $ID . $Password?>");
  </script>
<?php
} else {
?>
  <script>
	  alert("<?php echo '로그인 실패'?>");
	  location.replace("<?php echo $BackURL?>");
  </script>
<?php
  }
?>
</div>
</article>
    </form>
    <script>
      this.document.getElementById("loginValues").submit();
    </script>
  </body>
</html>
