<?php
	ob_start();
	session_start();
	require_once("./dbconfig.php");

//if(isset($_SESSION['filename'])){
//	$Filename	= $_SESSION['filename'];
//}
	$No = $_GET['no'];
	$ID = $_POST['ID'];
	$Password = $_POST['Password'];
	//$No = $_POST['no'];

	if(!empty($No) && empty($_COOKIE['table_board_' . $No])) {
		$sql = 'update table_board set hit = hit + 1 where no = ' . $No;
		$result = $db->query($sql);
		if(empty($result)) {
			?>
			<script>
				alert('Error');
				history.back();
			</script>
			<?php
		} else {
			setcookie('table_board_' . $No, TRUE, time() + (60 * 60 * 24), '/');
		}
	}

	$sql = 'select title, content, date, hit, id from table_board where no = ' . $No;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Board_free | Youngjin</title>
	<link rel="stylesheet" href="./css/normalize.css" />
	<link rel="stylesheet" href="./css/board.css" />
</head>
<script>
function List() {
    //alert("myJsFunc");
		location.replace("./index.php")
}
</script>
<body>
	<article class="boardArticle">
		<h3>Board_free_view</h3>
		<div id="boardView">
			<h3 id="boardTitle"><?php echo $row['title']?></h3>
			<div id="boardInfo">
				<span id="boardID">Writer: <?php echo $row['id']?></span>
				<span id="boardDate">Date: <?php echo $row['date']?></span>
				<span id="boardHit">Hit: <?php echo $row['hit']?></span>
			</div>
			<div id="boardContent"><?php echo $row['content']?></div>
			<!--<img src="./uploadfile/<?php echo $Filename;?>" />-->
			<div class="btnSet">
				<!--<a href="./write.php?no=<?php echo $No?>">Modify</a>-->
				<a href="./write.php?no=<?php echo $No?>">Modify</a>
				<a href="./delete.php?no=<?php echo $No?>">Delete</a>
				<a href="#" onclick="List();">List</a>
			</div>
		</div>
	</article>
</body>
</html>
