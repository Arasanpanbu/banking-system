<?php
// Include config file
require_once "config.php";

//$sql = "SELECT * FROM bs_users ORDER BY id";
$sql = "SELECT * FROM bs_accounts INNER JOIN bs_users ON bs_accounts.customer_id = bs_users.id";
$result = $link->query($sql);

$link->close();  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer's | Banking System</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">	
</head>
<body>

  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="welcome.php" class="navbar-brand d-flex align-items-center">
        <i class="fa fa-suitcase"></i>
        <strong>&nbsp;Banking System</strong>
      </a>
      <div class="pull-right">
		<a href="#" class="btn btn-secondary my-2">Login</a>
		<a href="#" class="btn btn-secondary my-2">Register</a>
	  </div>
    </div>
  </div>


  <section class="py-3 text-center container">
    <div class="row">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Welcome to Customer Page.</h1>		
      </div>
	</div>

  
    <div class="row py-4">	  
		<h4 class="text-primary mb-3"><b>CUSTOMER's DETAILS</b></h4>
		<table class="table table-hover" style="border:1px solid #ccc;">
		   <thead class="thead-dark" style="background-color:#0d6efd; color:#fff;">
				<tr>
					<th scope="col">ID</th>
					  <th scope="col">Customer Name</th>
					  <th scope="col">Email ID</th>
					 <th scope="col">Balance</th>
				</tr>
			</thead>
			<tbody>
				<!-- PHP CODE TO FETCH DATA FROM ROWS - LOOP TILL END OF DATA  --> 
				<?php while($rows=$result->fetch_assoc()) { ?>
				<tr>      
					<td><b><?php echo $rows['id'];?></b></td>
					<td><b><?php echo $rows['name'];?></b></td>
					<td><b><?php echo $rows['email'];?></b></td>
					<td><b><?php echo $rows['balance'];?></b></td>
				</tr>
				 <?php } ?> 
			</tbody>
		</table>
	</div>
	
	<div class="row py-3">
      <div class="col-lg-6 col-md-8 mx-auto">
        <p>
		  <a href="index.php" class="btn btn-success my-2">Back to Home</a>
		  <a href="transfer.php" class="btn btn-danger my-2">Money Transter</a>
        </p>
      </div>
	</div>


  </section>
  

</body>
</html>