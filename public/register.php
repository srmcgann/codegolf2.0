<?
	require("db.php");
	require("functions.php");
	$name=mysqli_real_escape_string($link,str_replace("'","",str_replace('"','',str_replace("<","&lt;",$_POST['user']))));
	$email=mysqli_real_escape_string($link,str_replace("'","",str_replace('"','',str_replace("<","&lt;",$_POST['email']))));
	$pass=mysqli_real_escape_string($link,md5($_POST['pass']));
	$newPass=password_hash($_POST['pass'], PASSWORD_DEFAULT);
	$sql="SELECT * FROM users WHERE name LIKE \"$name\" OR email LIKE \"$email\"";
	$res=$link->query($sql);
	if(!mysqli_num_rows($res)){
		$date=date("Y-m-d H:i:s",strtotime("now"));
		$IP=$_SERVER['REMOTE_ADDR'];
		$key=md5(rand());
		$sql="INSERT INTO users (name, email, pass, dateCreated, lastseen, IP, emailVerified, emailKey, newHash) VALUES(\"$name\",\"$email\",\"$pass\",\"$date\",\"$date\",\"$IP\",0,\"$key\",\"$newPass\")";
		$link->query($sql);
		setCookie("id",$link->insert_id,time()+2592000);
		setCookie("session",$pass,time()+2592000);
		sendVerificationEmail($name,$email,$key);
		echo 1;
	}
?>