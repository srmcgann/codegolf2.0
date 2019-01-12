<?
	require("db.php");
	require("functions.php");
	if(isset($_COOKIE["id"]) && isset($_COOKIE['session'])){
		$id=$_COOKIE["id"];
		$pass=$_COOKIE["session"];
		$email=mysqli_real_escape_string($link,$_POST['email']);
		$avatar=mysqli_real_escape_string($link,$_POST['avatar']);
		$imgData = str_replace(' ','+',$avatar);
		$imgData =  substr($imgData,strpos($imgData,",")+1);
		$imgData = base64_decode($imgData);
		$sql="SELECT id FROM users WHERE id = $id AND pass = \"$pass\"";
		$res=$link->query($sql);
		if(mysqli_num_rows($res)){
			$h=fopen("avatars/$id.jpg","w");
			fwrite($h,$imgData);
			fclose($h);
                        $h=fopen("../public/avatars/$id.jpg","w");
                        fwrite($h,$imgData);
                        fclose($h);
			if($email){
				$sql="UPDATE users SET email=\"$email\" WHERE id=$id";
				$link->query($sql);
			}
			$link->query($sql);
			echo 1;
		}
	}
?>
