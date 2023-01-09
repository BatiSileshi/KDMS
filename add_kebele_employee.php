

<?php

include('config/db_connect.php');

// validation

$fname = $lname  = $email  = '';
$errors = array('$fname'=>'', '$lname'=>'', '$email'=>'' );


if (isset($_POST['submit'])) {
	
	if (empty($_POST['fname'])) {
		$errors['fname']= "Your first name is required";
	} else {
		$fname=$_POST['fname'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
			$errors['fname']= "Please enter correct firstname";
		}
	}


	if (empty($_POST['lname'])) {
		$errors['lname']= "Your last name is required";
	} else {
		$lname=$_POST['lname'];
		if (!preg_match('/^[a-zA-Z\s]+$/', $lname)) {
			$errors['lname']= "Please enter correct lastname";
		}
	}
	
	
	
	if (empty($_POST['email'])) {
		$errors['email']= "Your email is required";
	} else {
		$email =$_POST['email'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "email must be valid";
		}

	} 


// filtering if there is error and then redirecting

if(array_filter($errors)){
	echo "errors in the form";
}else{
	$fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lname = mysqli_real_escape_string($conn, $_POST['lname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);

	// create sql
	$sql = "INSERT INTO employee(fname, lname,  email) VALUES ('$fname', '$lname', '$email')";

	//save to db
	if (mysqli_query($conn, $sql)) {
		// if success we direct it to the index
		header('location: home.php');
	}else{
		echo 'query error: '. mysqli_error($conn);
	}

	mysqli_close($conn);
	}

}

// end of validation
?>




<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>


<h4>KDMS Add kebele employee</h4>


		<form action="add_kebele_employee.php"  method="POST">
			<label>First Name:</label>
			<input type="text" name="fname" value="<?php echo htmlspecialchars($fname) ?>">
			<div style="color: red;"><?php echo $errors['fname']; ?></div>


			<label>Last Name:</label>
			<input type="text" name="lname" value="<?php echo htmlspecialchars($lname) ?>">
			<div style="color: red;"><?php echo $errors['lname']; ?></div>

			<label>Email:</label>
			<input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div style="color: red;"><?php echo $errors['email']; ?></div>

		  <input type="submit" name="submit" value="Register"  >
			
			
		</form>



<?php include('templates/footer.php') ?>
</html>