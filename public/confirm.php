<?
	require("db.php");
	$key=mysqli_real_escape_string($link,$_POST['k']);
	$email=mysqli_real_escape_string($link,$_POST['email']);
	$sql="SELECT * FROM users WHERE email=\"$email\" AND emailKey=\"$key\"";
	$res=$link->query($sql);
	if(mysqli_num_rows($res)){
		$row=mysqli_fetch_assoc($res);
		if(!$row['emailVerified']){
			$sql="UPDATE users SET emailVerified=1 WHERE email=\"$email\" AND emailKey=\"$key\"";
			$link->query($sql);
			$sql="SELECT id FROM users WHERE email=\"$email\" AND emailKey=\"$key\"";
			$res=$link->query($sql);
			$row=mysqli_fetch_assoc($res);
			copy("avatars/default.jpg","avatars/".$row['id'].'.jpg');
			echo 1;
		}
	}
?>