<!DOCTYPE html>
<html>
<head>
	<title>library</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<br><br>
				<a href="books.php" class="btn btn-info"><< Back</a>
				<h4>
<!--------------php code----------------------------------------------->
<?php 
	require_once('connection.php');//Database Connection

//Get Data of particular row
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql = "SELECT* FROM books WHERE id=$id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$name=$row["name"]; 
			$author=$row["author"]; 
			$description=$row['description'];
					        
			}
		} else {
			header("location:books.php");
		}		
		
	}

//Updating Records
	if(isset($_POST['update'])){
		$name=$_POST['name'];
		$author=$_POST['author'];
		$description=$_POST['description'];
		update($conn,$id,$name,$author,$description);//calling update function
	}
//Removing Records
	if(isset($_POST['remove'])){
		$id=$_POST['id'];
		remove($conn,$id);//calling remove function
	}
	
	//function for updating records
	function update($conn,$id,$name,$author,$description){
		$sql = "UPDATE books SET name='$name',author='$author',description='$description' WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    echo "Book updated successfully";
		} else {
		    echo "Failed updating book";
		}
	}
	//function for removing records
	function remove($conn,$id){
		$sql = "DELETE FROM books WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    echo "Book removed successfully";
		} else {
		    echo "Failed removing record";
		}
	}

 ?>

<!--------------php code end----------------------------------------------->
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<h3>Edit / Delete Book</h3>
				<form action="edit.php?id=<?php echo $id; ?>" method="POST">
					Book ID
					<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly>
					Book Name
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
					Author
					<input type="text" name="author" class="form-control" value="<?php echo $author; ?>" required>
					Description
					<input type="text" name="description" class="form-control" value="<?php echo $description; ?>" required>
					<br>
					<input type="submit" name="update" value="Update" class="btn btn-primary">
					<input type="submit" name="remove" value="Remove" class="btn btn-danger"><br>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>
