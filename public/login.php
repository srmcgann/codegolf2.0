<?
	require("db.php");
	$user=mysqli_real_escape_string($link,$_POST['user']);
	$pass=md5(mysqli_real_escape_string($link,$_POST['pass']));
	$field=$_POST['isEmail']=="true"?"email":"name";
	$sql="SELECT * FROM users WHERE $field LIKE \"$user\" AND pass = \"$pass\"";
	$res=$link->query($sql);
	if(mysqli_num_rows($res)){
		$row=mysqli_fetch_assoc($res);
		setCookie("id",$row['id'],time()+2592000);
		setCookie("session",$pass,time()+2592000);
		echo $row['name'];
	}
?>