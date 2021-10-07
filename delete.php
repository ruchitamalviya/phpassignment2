<?php
	include 'conn.php';
	$delid = $_POST['id'];
	$sql = "DELETE FROM `index_search` WHERE id ='$delid'";
	if(mysqli_query($conn,$sql))
	{
		echo 1;
	}else
	{
		echo 0;
	}
?>