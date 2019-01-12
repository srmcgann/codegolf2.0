<?
	require("functions.php");

	$postsPerScroll=1;
	$id=$_POST['id'];
	$sql="SELECT * FROM applets WHERE id=$id";
	$res=$link->query($sql);
	if(mysqli_num_rows($res)){
		$row=mysqli_fetch_assoc($res);
		drawApplet($row,1);
	}else{
		echo "<br><br><br>Applet was not found!";
	}
?>