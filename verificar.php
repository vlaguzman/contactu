<?php


if (isset($_GET['fname'])) {
	$twitter = $_GET['twitter'];
	$name = $_GET['fname'] . " ". $_GET['lname']; 
	$industry = $_GET['industry']; 
	$email = $_GET['email']; 
	$photo = $_GET['photo'];
?>
<script type="text/javascript">
	alert("yeah");
</script>
<?php

	echo "<script language='javascript'>loginLinkedin($name,$email,$twitter,$industry,$photo,$email,'','');</script>";
} 




?>