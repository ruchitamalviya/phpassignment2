<?php
	include 'conn.php';
	$editid = $_POST['id'];
	$updateword = $_POST['updatevalue'];
	if ($editid && $updateword) {
		$sql="UPDATE `index_search` SET `word` = '$updateword' WHERE `index_search`.`id` = '$editid'";
		if(mysqli_query($conn,$sql)) {
			echo json_encode(array('success' => 1));
		} else {
			echo json_encode(array('success' => 0));
		}
	}
?>