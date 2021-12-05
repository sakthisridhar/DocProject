<?php
include_once("db_connect.php");
$sql = "SELECT * FROM docupload where id=".$_GET['id'];
$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0) {
	header("location: index.php");
}else{
	$row = mysqli_fetch_assoc($result);
	unlink($row['doc_file_name']);
	$sql = "delete FROM docupload where id=".$_GET['id'];
	$result = $conn->query($sql);
	header("location: index.php");
}
?>