<?
	require("functions.php");
	$userID=$_COOKIE['id'];
	$pass=$_COOKIE['session'];
	$sql="SELECT * FROM users WHERE id=$userID AND pass=\"$pass\"";
	$res=$link->query($sql);
	if(mysqli_num_rows($res)){
		$row=mysqli_fetch_assoc($res);
		$admin=$row['admin'];
		$id=$_POST['id'];
		$sql="SELECT * FROM applets WHERE id=$id";
		$res=$link->query($sql);
		$row=mysqli_fetch_assoc($res);
		if($userID==$row['userID'] || $admin){
			$sql="DELETE FROM applets WHERE id=$id";
			$link->query($sql);
			$sql="DELETE FROM votes WHERE appletID=$id";
			$link->query($sql);
			$sql="SELECT * FROM votes where userID=$userID";
			$res=$link->query($sql);
			$rating=0;
			for($i=0;$i<mysqli_num_rows($res);++$i){
				$row=mysqli_fetch_assoc($res);
				$rating+=$row['vote']-1;
			}
			$rating/=mysqli_num_rows($res);
			$rating*=20;
			$sql="UPDATE users SET rating = \"$rating\" WHERE id=$userID";
			$link->query($sql);
			$sql="UPDATE applets SET formerUserID=0, formerAppletID=0 WHERE formerAppletID=$id";
			$link->query($sql);
		}else{
			echo "fail\n".$userID;
		}
	}else{
		echo "fail\n".$userID;
	}
?>