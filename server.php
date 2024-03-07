<?php include 'connection.php';?>

<?php
if(isset($_POST['submit'])) {
	$name = strip_tags($_POST['name']);
	$lastname = strip_tags($_POST['lastname']);
	$email = strip_tags($_POST['email']);
	$gender = strip_tags($_POST['gender']);
	$subject = strip_tags($_POST['subject']);
	$description= strip_tags($_POST['description']);
	
	$name = $connect->real_escape_string($name);
	$lastname = $connect->real_escape_string($lastname);
	$email = $connect->real_escape_string($email);
	$gender = $connect->real_escape_string($gender);
	$subject = $connect->real_escape_string($subject);
	$description = $connect->real_escape_string($description);
	
	
	$check_email = $connect->query("SELECT email FROM user_info WHERE email='$email'");
	$count=$check_email->num_rows;
	
	if ($count==0) {
		
		$query = "INSERT INTO user_info(first_name, last_name, email, gender, subject, description) VALUES('$name','$lastname','$email','$gender', '$subject', '$description')";

		if ($connect->query($query)) {

                        echo "<div style='color:#73AD21;text-align:center; padding: 7px'> Information was submitted successfully!</div>";
                        $varArray = array(
                              "Name: $name",
                              "Last Name: $lastname",
                              "Email: $email",
                              "Gender: $gender",
                              "Subject: $subject",
                              "Description: $description"
                        );
                        $snsmessage = implode("\n", $varArray);
                        $escaped_message = escapeshellarg($snsmessage);
                        $command = "python3 sns.py $escaped_message";
                        $output = shell_exec($command);
//                        echo $output;

		}else {
			echo "<div style='color:red;text-align:center;padding: 7x'>Error occured while submitting your information. Please try again</div>".$connect->connect_errno;
		}
		
	} else {
		
		
		echo "<div style='color:red;text-align:center;padding: 7px'>Sorry email already taken!</div>";
			
	}


	$connect->close();
}
?>
