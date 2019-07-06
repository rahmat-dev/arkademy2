<?php

require_once 'koneksi.php';

if (isset($_POST['name']) && isset($_POST['hobby']) && isset($_POST['category'])) {
	$name = $_POST['name'];
	$hobby = $_POST['hobby'];
	$category = $_POST['category'];

	mysqli_query($conn, "INSERT INTO nama(name, id_hobby, id_category) VALUES('$name', $hobby, $category)");
}

header('Location: index.php');