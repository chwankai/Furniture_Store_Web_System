<?php 
require_once("includes/config.php");
if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	// Validate email domain
	$allowedDomains = array('gmail.com', 'student.mmu.edu.my','yahoo.com','soffice.mmu.edu.my','outlook.com','icloud.com','mmu.edu.my');
	$emailDomain = explode('@', $email);
	$emailDomain = end($emailDomain);
	if(!in_array($emailDomain, $allowedDomains)) {
		echo "<span style='color:red'> Email domain is not valid. Only ". implode(', ', $allowedDomains). " domains are allowed.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else {
		$result =mysqli_query($con,"SELECT  email FROM  users WHERE  email='$email'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Email already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Email available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}

?>
