<!DOCTYPE html>
<html>
<head>
	<!--by semicolonn id on 3 9 2020-->
	<title>CRUD APP HOME</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</head>
<body>

	<div class="container">
			<h2>List of users</h2>
	<form method="POST" action="" class="form-group">

		<?php $flag= false;


		$conn= mysqli_connect("localhost", "root","","crudphp");
		if(!$conn){
			echo "Error in connection!";
		}


		//fetch record from the table to form inputs for updating preparation

		if (isset($_POST['ed'])) {
			
			$flag= true;

			$id=$_POST['ed'];
			//echo $id;

			$sql="SELECT* FROM users WHERE id=$id";

			$r=mysqli_query($conn, $sql);

			if (mysqli_num_rows($r)>0) {
				
				$re=mysqli_fetch_array($r);
				$i=$re['id'];
				$n=$re['name'];
				$p=$re['passwordid'];
			}


		}
		 ?>


		<?php if($flag==false):?>
				
		<input type="text" name="name" placeholder="Username" value="" class="form-control"><br>
		<input type="text" name="password" placeholder="Password" value="" class="form-control">

		<?php else: ?>
		<input type="hidden" name="id" value="<?php echo $i; ?>">
		<input type="text" name="name" placeholder="Username" value="<?php echo $n; ?>" class="form-control">
		<br>
		<input type="text" name="password" placeholder="Password" value="<?php echo $p; ?>" class="form-control">
		<?php endif ?>


		<?php if($flag==true):?>
			<br>
			<button name="update" class="btn btn-success">Update Details</button>
		<?php else: ?>
			<br>
			<button name="btn_creat" class="btn btn-primary">Creat Account</button>
		<?php endif ?>


		<hr>
		<br>
		<br>
		<br>
		<table class="table table-hover">
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Password</th>
				<th scope="col" colspan="2">Operation</th>
			</tr>		
	<?php 

		//DISPLAY RECORDS TO THE TABLE
		$sql="SELECT* FROM users";

		$res= mysqli_query($conn, $sql);

		if(mysqli_num_rows($res)>0){

			while ($row=mysqli_fetch_array($res)) { ?>


			<tr>
				<td><?php echo $row['id'];?></td>
				<td><?php echo $row['name'];?></td>
				<td><?php echo $row['passwordid'];?></td>
				
					<td><button name="del" value="<?php echo $row['id']?>" class="btn btn-danger">Delete</button></td>	
					<td><button name="ed" value="<?php echo $row['id']?>" class="btn btn-primary">Edit</button></td>
			</tr>	


		<?php //close if and while loop
			}
		}

			?>		


			<?php

				//CREAT ACCOUNT
			if (isset($_POST['btn_creat'])) {
				
				$username=$_POST['name'];
				$passworduser=$_POST['password'];

				$sql="INSERT INTO users VALUES(NULL,'$username','$passworduser');";

				if (mysqli_query($conn, $sql)) {

					echo "<div class='alert alert-success' role='alert'>Account Created!</div>";
				}
			}


	
				//UPDATED THE DETAILS IN DATABASE

				elseif (isset($_POST['update'])) {
					$getId=$_POST['id'];
					$getName=$_POST['name'];
					$getPwd=$_POST['password'];

					$sql="UPDATE users SET name='$getName', passwordid='$getPwd' WHERE id='$getId'";

					if (mysqli_query($conn, $sql)) {
					echo "<div class='alert alert-success' role='alert'>Account Updated!</div>";
					}
				}

			?>

			<?php 
			// DELETE RECORD FROM DATABASE
			if (isset($_POST['del'])) {
				$id=$_POST['del'];
				//echo $id;

				$sql="DELETE FROM users WHERE id='$id'";

				$del_result=mysqli_query($conn, $sql);

				if($del_result){
					echo "<div class='alert alert-success' role='alert'>Account Deteted!</div>";

				}
			}

			//END OF PHP PROCESSING?>


			</table>	
			</form>
		</div>
</body>
</html>


