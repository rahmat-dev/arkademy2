<?php

require_once 'koneksi.php';

if (isset($_POST['id_name'])) {
	$id = $_POST['id_name'];
	mysqli_query($conn, "DELETE FROM nama WHERE id=$id");
}

header('Location: index.php');