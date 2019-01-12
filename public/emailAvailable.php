<?
	require("db.php");
	$email=mysqli_real_escape_string($link,$_POST['email']);
	$sql="SELECT * FROM users WHERE email LIKE \"$email\"";
	$res=$link->query($sql);
	if(!mysqli_num_rows($res))echo 1;
?>