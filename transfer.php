<?php
// Include config file
require_once "config.php";

// Prepare an update statement
$sent_users = $link->query("SELECT * FROM bs_users");
$receive_users = $link->query("SELECT * FROM bs_users");


// Define variables and initialize with empty values
$new_balance = $sender_id = $receiver_id = "";
$new_balance_err = $sender_id_err = $receiver_id_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new balance
    if(empty(trim($_POST["new_balance"]))){
        $new_balance_err = "Please enter the transfer amount.";     
    } else{
        $new_balance = trim($_POST["new_balance"]);
    }
	
	// Validate Sender
    if(empty(trim($_POST['sender_id']))){
        $sender_id_err = "Please enter the sender id.";     
    } else{
        $sender_id = trim($_POST['sender_id']);
    }
	
	// Validate Receiver
    if(empty(trim($_POST['receiver_id']))){
        $receiver_id_err = "Please enter the receiver id.";     
    } else{
        $receiver_id = trim($_POST['receiver_id']);
    }
        
    // Check input errors before updating the database
    if(empty($new_balance_err && $sender_id_err && $receiver_id_err)){
		
        // Prepare an update statement
        $sql_bal_dec = "UPDATE bs_accounts SET balance = balance - ? WHERE customer_id = ?";        
        if($stmt = mysqli_prepare($link, $sql_bal_dec)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_balance, $param_sender_id);            
            // Set parameters
            $param_balance = $new_balance;
            $param_sender_id = $sender_id;
			
			// Execute statement
			mysqli_stmt_execute($stmt);
			
			// Close statement
			mysqli_stmt_close($stmt);            
        }
		
		// Prepare an update statement
		$sql_bal_inc = "UPDATE bs_accounts SET balance = balance + ? WHERE customer_id = ?";		
		if($stmt2 = mysqli_prepare($link, $sql_bal_inc)){
            // Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt2, "si", $param_balance, $param_receiver_id);
			
            // Set parameters
            $param_balance = $new_balance;
			$param_receiver_id = $receiver_id;
		
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt2)){
                // Password updated successfully. Destroy the session, and redirect to login page
                //session_destroy();
                header("location: customer.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement            
			mysqli_stmt_close($stmt2);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transfer | Banking System</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">	
</head>
<body>
	<div class="navbar navbar-dark bg-dark shadow-sm">
		<div class="container">
			<a href="welcome.php" class="navbar-brand d-flex align-items-center">
				<i class="fa fa-suitcase"></i>
				<strong>&nbsp;Banking Sector</strong>
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
			<h1 class="fw-light">Welcome to Money Transfer Page.</h1>		
		  </div>
		</div>
		
		<div class="row py-3">
		  <div class="col-lg-6 col-md-8 mx-auto">
			<h4 class="text-primary mb-3"><b>Transfer Money below</b></h4>
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signin-form">			

				<div class="form-group mb-3 <?php echo (!empty($new_balance_err)) ? 'has-error' : ''; ?>">					
					<label class="label" for="sender_id"> FROM </label>
					<select class="form-select" name="sender_id"> 
					    <!-- // LOOP TILL END OF DATA -->
						<?php while($rows=$sent_users->fetch_assoc()) { ?>
							<option class="form-control" value = "<?php echo $rows['id'];?>" ><?php echo $rows['name'];?></option>					
						<?php } ?> 
					</select>					
				</div>
				
				<div class="form-group mb-3 <?php echo (!empty($new_balance_err)) ? 'has-error' : ''; ?>">
					<input type="text" name="new_balance" class="form-control" placeholder="Transter Amount" value="<?php echo $new_balance; ?>">
					<span class="help-block"><?php echo $new_balance_err; ?></span>
				</div>
				
				<div class="form-group mb-3 <?php echo (!empty($new_balance_err)) ? 'has-error' : ''; ?>">					
					<label class="label" for="receiver_id"> TO </label>
					<select class="form-select" name="receiver_id"> 
					    <!-- // LOOP TILL END OF DATA -->
						<?php while($rows=$receive_users->fetch_assoc()) { ?>
							<option class="form-control" value = "<?php echo $rows['id'];?>" ><?php echo $rows['name'];?></option>					
						<?php } ?> 
					</select>					
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-success my-2" value="Submit">
					<a class="btn btn-danger my-2" href="index.php">Cancel</a>
				</div>
			</form>
		  </div>
		</div>
	</section>       
</body>
</html>