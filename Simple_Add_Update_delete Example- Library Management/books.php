<?php 

	require_once('connection.php');
	if(isset($_GET['id'])){
		echo "ela";
	}
	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$author=$_POST['author'];
		$description=$_POST['description'];
		$query = "INSERT INTO books (name, author, description)
	    VALUES ('$name', '$author' , '$description')";

	    if ($conn->query($query) === TRUE) {
	        header("location:books.php");
	        
	    } else {
	        echo "Error: " . $query . "<br>" . $conn->error;
	    }
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			
			<div class="col-sm-8">
				<h3>Add New Book</h3>
				<form action="books.php" method="POST">
					Book Name
					<input type="text" name="name" class="form-control" required>
					Author
					<input type="text" name="author" class="form-control"required>
					Description
					<input type="text" name="description" class="form-control" required>
					<br>
					<input type="submit" name="submit" value="Submit" class="btn btn-primary"><br>
				</form>
				<h3>Book List</h3>
				<?php 

					$sql = "SELECT* FROM books";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					        ?>
					        	<div class="well">
					        		<?php echo $row["id"]; ?>&nbsp &nbsp
					        		<?php echo $row["name"]; ?>&nbsp &nbsp
					        		<?php echo $row["author"]; ?>
					        		<a href="edit.php?id=<?php echo $row["id"]; ?>" style="float: right;">Edit</a>
					        	</div>
					        <?php
					    }
					} else {
					    echo "0 results";
					}


				 ?>


			</div>
		</div>
	</div>
</body>
</html>
