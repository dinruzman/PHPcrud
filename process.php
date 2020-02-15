<?php

session_start();

$mysqli = mysqli_connect('localhost','root','1234','crud') or die (mysqli_error($mysqli));

$id =0;
$name ="";
$location ="";
$update = false;

if(isset($_POST['save'])){
	$name = $_POST['name'];
	$location = $_POST['location'];
	
	$query = mysqli_query($mysqli,"INSERT INTO data (name,location) VALUES ('$name','$location')") or die (mysqli_error($mysqli));
	
	$_SESSION['message'] = "Record has been added!";
	$_SESSION['msg_type'] = "success";
	
	header("location: index.php");
}

if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$query = mysqli_query($mysqli,"DELETE FROM data WHERE id=$id") or die(mysqli_error($mysqli));
	
	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	
	header("location: index.php");
}

if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$query = mysqli_query($mysqli,"SELECT * FROM data WHERE id=$id") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($query)==1){
		$row = mysqli_fetch_array($query);
		$name = $row['name'];
		$location = $row['location'];
	}
}

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	
	$query = mysqli_query($mysqli,"UPDATE data SET name='$name', location='$location' WHERE id=$id") or die (mysqli_error($mysqli));
	
	$_SESSION['message'] = "Record has been updated";
	$_SESSION['msg_type'] = "warning";
	
	header("location: index.php");
}

?>