<?
	require("db.php");
	$userID=$_COOKIE['id'];
	$pass=mysqli_real_escape_string($link,$_COOKIE['session']);
	$sql="SELECT * FROM users WHERE id=$userID AND pass=\"$pass\"";
	$res=$link->query($sql);
	if(mysqli_num_rows($res)){
		$row=mysqli_fetch_assoc($res);
		$name=$row['name'];
		$code=str_replace("\r\n","\n",$_POST['code']);
		$bytes=mb_strlen($code);
		if($bytes>1024){
			echo "fail";
		}else{
			$webgl=mysqli_real_escape_string($link,$_POST['webgl']);
			$code=mysqli_real_escape_string($link,$code);
			$formerUserID=mysqli_real_escape_string($link,$_POST['formerUserID']);
			$formerAppletID=mysqli_real_escape_string($link,$_POST['formerAppletID']);
			$date=date("Y-m-d H:i:s",strtotime("now"));
			$sql="INSERT INTO applets (userID,code,rating,votes,date,formerUserID,formerAppletID,bytes,webgl) VALUES($userID,\"$code\",0,0,\"$date\",$formerUserID,$formerAppletID,$bytes,$webgl)";
			$link->query($sql);


                        $id=$link->insert_id;
	                require("functions.php");
			$vote=6;
	                $IP=ipToDec($_SERVER['REMOTE_ADDR']);

        	        $sql="SELECT userID FROM applets where id=$id";
                	$res=$link->query($sql);
	                $row=mysqli_fetch_assoc($res);
	                $userID=$row['userID'];

        	        $sql="SELECT * FROM votes WHERE IP=$IP AND appletID=$id";
	                $res=$link->query($sql);
        	        if(mysqli_num_rows($res)){
                	        $sql="UPDATE votes SET vote=$vote WHERE IP=$IP AND appletID=$id";
                        	$link->query($sql);
	                }else{
        	                $sql="INSERT INTO votes (IP,appletID,vote,userID) VALUES($IP,$id,$vote,$userID)";
	                        $link->query($sql);
	                }

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
	                $res=$link->query($sql);

        	        $sql="SELECT vote FROM votes WHERE appletID=$id";
	                $res=$link->query($sql);
	                $votes=mysqli_num_rows($res);
	                $total=0;
	                for($i=0;$i<$votes;++$i){
	                        $row=mysqli_fetch_assoc($res);
	                        $total+=($row['vote']-1);
	                }
	                $rating=$total/$votes*20;
	                $sql="UPDATE applets SET rating=$rating, votes=$votes WHERE id=$id";
	                $link->query($sql);
			echo $name;
		}

	}else{
		echo "fail";
	}
?>
