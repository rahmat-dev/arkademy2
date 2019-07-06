<?php

require_once 'koneksi.php';

if (isset($_POST['id_name']) && isset($_POST['name']) && isset($_POST['hobby']) && isset($_POST['category'])) {
	$id = $_POST['id_name'];
	$name = $_POST['name'];
	$hobby = $_POST['hobby'];
	$category = $_POST['category'];

	mysqli_query($conn, "UPDATE nama SET name='$name', id_hobby=$hobby, id_category=$category WHERE id=$id");
}

header('Location: index.php');