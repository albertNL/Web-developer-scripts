<?php

require 'common.php';

if (isset($_POST['submit'])) {

	require "config.php";	

	try {
	$connection = new PDO($dsn, $username, $password, $options);

	$new_record = array(
		"firstname" => $_POST['firstname'],
		"lastname" => $_POST['lastname'],
		"appname" => $_POST['appname'],
		"pd" => $_POST['pd'],
	);

	$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"records",
		implode(", ", array_keys($new_record)),
		":" . implode(", :", array_keys($new_record))
	);

	$statement = $connection->prepare($sql);
	$statement->execute($new_record);
	}

	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php include 'templates/header.php'; ?>


<?php
if (isset($_POST['submit']) && $statement)
{ ?>
	<blockquote><?php echo escape($_POST['firstname']); ?> successfully added</blockquote>
<?php
} ?>


<h2>Add a record</h2>

<form method="post">
	<label for="firstname">First name</label>
	<input type="text" name="firstname" id="firstname">
	<label for="lastname">Last name</label>
	<input type="text" name="lastname" id="lastname">
	<label for="appname">Application name</label>
	<input type="text" name="appname" id="appname">
	<label for="pd">Personal data</label>
	<input type="text" name="pd" id="pd">

	<input type="submit" name="submit" value="Submit">
</form>
<br><br>
<a href="index.php">Back to home</a>

<?php include 'templates/footer.php'; ?>