<?php

require_once 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Arkademy Bootcamp</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<header class="navbar-light bg-white"  style="box-shadow: 0px 0px 3px .5px rgba(0,0,0,0.5);">
		<nav class="navbar container">
		  <a class="navbar-brand" href="#">Arkademy Bootcamp</a>
		</nav>
	</header>

	<main class="container mt-5">
		<button class="btn btn-warning text-white float-right mb-2" data-target="#modalAddData" data-toggle="modal">Add Data</button>

		<!-- Modal Add Data -->
		<div class="modal fade" id="modalAddData" tabindex="-1" role="dialog" aria-labelledby="modalAddDataTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modalAddDataTitle">Add Data</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form method="post" action="add.php">
		          <div class="form-group">
		            <input type="text" class="form-control" id="inputName" placeholder="Name ..." name="name">
		          </div>
	            <div class="form-group">
	              <select id="inputHobby" class="form-control" name="hobby">
	                <option selected>Hobby ...</option>
	                <?php
	                	$result = mysqli_query($conn, "SELECT * FROM hobi");
	                	if (mysqli_num_rows($result) > 0) :
	                		while ($row = mysqli_fetch_assoc($result)) :
	                ?>
	                <option value="<?=$row['id']?>"><?=$row['name']?></option>
	                <?php
	                		endwhile;
	                	endif;
	                ?>
	              </select>
	            </div>
	            <div class="form-group">
	              <select id="inputCategory" class="form-control" name="category">
	                <option selected>Category ...</option>
	                <?php
	                	$result = mysqli_query($conn, "SELECT * FROM kategori");
	                	if (mysqli_num_rows($result) > 0) :
	                		while ($row = mysqli_fetch_assoc($result)) :
	                ?>
	                <option value="<?=$row['id']?>"><?=$row['name']?></option>
	                <?php
	                		endwhile;
	                	endif;
	                ?>
	              </select>
	            </div>
		          <button type="submit" class="btn btn-warning float-right text-white">Add</button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-white table-bordered table-hover table-sm text-center">
			  <thead class="thead-dark|thead-light">
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Hobby</th>
			      <th scope="col">Category</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  		$query = "SELECT nama.id, nama.name AS name, hobi.name AS hobby_name, kategori.name AS cat_name FROM ((nama INNER JOIN hobi ON nama.id_hobby = hobi.id) INNER JOIN kategori ON nama.id_category = kategori.id)";
			  		$result = mysqli_query($conn, $query);
			  		// die(var_dump($result));
			  		if (mysqli_num_rows($result) > 0) :
			  			while ($row = mysqli_fetch_assoc($result)) :
			  	?>
			    <tr>
			      <td><?= $row['name'] ?></td>
			      <td><?= $row['hobby_name'] ?></td>
			      <td><?= $row['cat_name'] ?></td>
			      <td>
			      	<a href="#modalDeleteData-<?=$row['id']?>" data-toggle="modal" class="btn btn-danger">Hapus</a>
			      	<a href="#modalEditData-<?=$row['id']?>" data-toggle="modal" class="btn btn-primary">Edit</a>
			      </td>
			    </tr>
			    <?php
				    	endwhile;
				    endif;
			    ?>
			  </tbody>
			</table>

			<!-- Modal Delete Data -->
			<?php
				$result = mysqli_query($conn, "SELECT * FROM nama");

				if (mysqli_num_rows($result) > 0) :
					while ($row = mysqli_fetch_assoc($result)) :
			?>
			<div class="modal fade" id="modalDeleteData-<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalDeleteDataTitle<?=$row['id']?>" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <!-- <h5 class="modal-title" id="modalDeleteDataTitle">Hapus Data</h5> -->
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body text-center">
			      	<h4 class="my-3">Yakin ingin menghapus data <?=$row['name']?>?</h4>
			      	<form method="post" action="delete.php">
			      		<input type="hidden" value="<?=$row['id']?>" name="id_name">
			      		<button type="submit" class="btn btn-danger float-right">Hapus</button>
			      		<button type="button" class="btn btn-dark float-right mr-2" data-dismiss="modal">Batal</button>
			      	</form>
			      </div>
			    </div>
			  </div>
			</div>

			<!-- Modal Edit Data -->
			<div class="modal fade" id="modalEditData-<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="modalEditDataTitle<?=$row['id']?>" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="modalEditDataTitle<?=$row['id']?>">Edit Data</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form method="post" action="edit.php">
			        	<input type="hidden" name="id_name" value="<?=$row['id']?>">
			          <div class="form-group">
			            <input type="text" class="form-control" id="inputName" placeholder="Name ..." value="<?=$row['name']?>" name="name">
			          </div>
		            <div class="form-group">
		              <select id="inputHobby" class="form-control" name="hobby">
		                <?php
		                	$resultHobby = mysqli_query($conn, "SELECT * FROM hobi");
		                	if (mysqli_num_rows($resultHobby) > 0) :
		                		while ($rowHobby = mysqli_fetch_assoc($resultHobby)) :
		                ?>
		                <option <?= $row['id_hobby']==$rowHobby['id'] ? 'selected' : null ?> value="<?=$rowHobby['id']?>"><?=$rowHobby['name']?></option>
		                <?php
		                		endwhile;
		                	endif;
		                ?>
		              </select>
		            </div>
		            <div class="form-group">
		              <select id="inputCategory" class="form-control" name="category">
		                <?php
		                	$resultCategory = mysqli_query($conn, "SELECT * FROM kategori");
		                	if (mysqli_num_rows($resultCategory) > 0) :
		                		while ($rowCategory = mysqli_fetch_assoc($resultCategory)) :
		                ?>
		                <option <?= $row['id_category']==$rowCategory['id'] ? 'selected' : null ?> value="<?=$rowCategory['id']?>"><?=$rowCategory['name']?></option>
		                <?php
		                		endwhile;
		                	endif;
		                ?>
		              </select>
		            </div>
			          <button type="submit" class="btn btn-warning float-right text-white">Edit</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
			<?php
					endwhile;
				endif;
			?>

		</div>
	</main>
</body>
</html>