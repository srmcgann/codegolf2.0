<?
	require("functions.php");
	$userID=$_COOKIE['id'];
	$pass=mysqli_real_escape_string($link, $_COOKIE['session']);
	$sql="SELECT * FROM users WHERE id=$userID AND pass=\"$pass\"";
	$res=$link->query($sql);
	if(mysqli_num_rows($res)){
		$comment=mysqli_real_escape_string($link,$_POST['comment']);
		$comment=str_replace(":)","😊",$comment);
		$comment=str_replace(":D","😃",$comment);
		$appletID=mysqli_real_escape_string($link,$_POST['id']);
		$date=date("Y-m-d H:i:s",strtotime("now"));
		$sql="INSERT INTO comments (appletID, userID, comment, date) VALUES($appletID, $userID, \"$comment\", \"$date\")";
		$link->query($sql);
	}else{
		echo "fail";
	}
