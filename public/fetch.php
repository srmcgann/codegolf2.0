<?
	require("functions.php");
  // $_POST = json_decode(file_get_contents('php://input'), true);
	if(isset($_POST['scroll'])){
		$postsPerScroll=6;
		if(isset($_POST['u']) && $_POST['u']){
			$user=mysqli_real_escape_string($link,$_POST['u']);
			$sql="SELECT * FROM users WHERE name LIKE \"$user\"";
			$res=$link->query($sql);
			if(mysqli_num_rows($res)){
				$row=mysqli_fetch_assoc($res);
				$id=$row['id'];
				$sql="SELECT * FROM applets WHERE userID=$id";
				$filter=$_POST['filter'];
				if($filter=="140"){
					$sql.=" AND bytes <= 140";
				}elseif($filter=="512"){
					$sql.=" AND bytes >140 AND bytes <= 512";
				}elseif($filter=="1024"){
					$sql.=" AND bytes > 512";
				}
				$sql.=" ORDER BY date DESC";
				$res=$link->query($sql);
				if(mysqli_num_rows($res)){
					$count=0;
					for($i=0;$i<mysqli_num_rows($res);++$i){
						$count++;
						$row=mysqli_fetch_assoc($res);
						if($count>$_POST['scroll']*$postsPerScroll && $count<=$_POST['scroll']*$postsPerScroll+$postsPerScroll){
							drawApplet($row);
						}
					}
				}else{
					echo "<br><br><br>$user has not made any applets yet in this category!";
				}
			}else{
				echo "<br><br><br>User not found... :(";
			}
		}else{
			$sql="SELECT * FROM applets WHERE votes = 0 OR rating > 50";
			$filter=$_POST['filter'];
			if($filter=="140"){
				$sql.=" AND bytes <= 140";
			}elseif($filter=="512"){
				$sql.=" AND bytes > 140 AND bytes <= 512";
			}elseif($filter=="1024"){
				$sql.=" AND bytes > 512";
			}
			$sql.=" ORDER BY (1/(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(date))*(1+rating*votes)) DESC";
			$res=$link->query($sql);
			if(mysqli_num_rows($res)){
				$count=0;
				for($i=0;$i<mysqli_num_rows($res);++$i){
					$row=mysqli_fetch_assoc($res);
					$count++;
					if(!in_array($row['id'],json_decode($_POST['IDs']))){
						if($count>$_POST['scroll']*$postsPerScroll && $count<=$_POST['scroll']*$postsPerScroll+$postsPerScroll){
							drawApplet($row);
						}
					}
				}
			}else{
				echo "<br><br><br>No one has made any applets yet in this category!";
			}
		}
	}
?>
