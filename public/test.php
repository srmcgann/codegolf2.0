<?
	//echo password_hash("123456",PASSWORD_DEFAULT);
	
	/*
	echo password_hash("stinkfizzle25", PASSWORD_DEFAULT);
	echo "<br>";
	echo md5("stinkfizzle25");
	*/

	
	function intToIP($int) {
	    $part1 = $int & 255;
	    $part2 = (($int >> 8) & 255);
	    $part3 = (($int >> 16) & 255);
	    $part4 = (($int >> 24) & 255);
	    return $part4 . "." . $part3 . "." . $part2 . "." . $part1;
	}
	echo intToIP(2022881812);	
	

	//echo md5("123456");

	/*

	require("db.php");
	$sql="SELECT code,id FROM applets";
	$res=$link->query($sql);
	for($i=0;$i<mysqli_num_rows($res);++$i){
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		$bytes=strlen(str_replace("\r\n","\n",$row['code']));
		$sql="UPDATE applets SET bytes=$bytes WHERE id=$id";
		$link->query($sql);
	}
	echo "done.";
	*/

?>
