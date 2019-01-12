<?
	require("functions.php");
	function rating($id){
		global $link;
		$sql="SELECT userID, rating, votes FROM applets WHERE id = $id";
		$res=$link->query($sql);
		$row=mysqli_fetch_assoc($res);
		$userID=$row['userID'];
        $data['number_votes'] = $row['votes'];
        $data['dec_avg'] = round($row['rating'],1);
		$IP=ipToDec($_SERVER['REMOTE_ADDR']);
		$sql="SELECT vote FROM votes WHERE appletID = $id AND IP=$IP";
		$res=$link->query($sql);
		$row=mysqli_fetch_assoc($res);
        $data['user_vote'] = $row['vote'];

		$sql="SELECT rating FROM users WHERE id = $userID";
		$res=$link->query($sql);
		$row=mysqli_fetch_assoc($res);
        $data['userRating'] = round($row['rating'],1);
        return json_encode($data);		
	}
	if(isset($_POST['fetch'])&&$_POST['fetch']==1){
		$id=$_POST['id'];
		echo rating($id);
	}elseif(isset($_POST['id'])){
		preg_match('/cloud_([1-6]{1})/', $_POST['clicked_on'], $match);
		$vote=$match[1];
		$IP=ipToDec($_SERVER['REMOTE_ADDR']);
		$id=$_POST['id'];

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
		echo rating($id);
	}
?>