<?
	require("db.php");
	$name=mysqli_real_escape_string($link,$_POST['name']);
	$sql="SELECT * FROM users WHERE name LIKE \"$name\"";
	$res=$link->query($sql);
	if(!mysqli_num_rows($res))echo 1;
?>