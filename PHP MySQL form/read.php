<?php

if(isset($_POST['submit']))
{
	try
	{
		require 'config.php';
		require 'common.php';

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT *
				FROM records
				WHERE appname = :appname";

		$appname = $_POST['appname'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':appname', $appname, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}

	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>


<?php include 'templates/header.php'; ?>


<?php
if (isset($_POST['submit']))
{
	if ($result && $statement->rowCount() > 0)
	{ ?>
		<h2>Results</h2>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>App Name</th>
					<th>Personal data</th>
				</tr>
			</thead>
			<tbody>
		<?php
			foreach ($result as $row)
			{ ?>
				<td><?php echo escape($row['id']); ?></td>
				<td><?php echo escape($row['firstname']); ?></td>
				<td><?php echo escape($row['lastname']); ?></td>
				<td><?php echo escape($row['appname']); ?></td>
				<td><?php echo escape($row['pd']); ?></td>
			<?php
			} ?>
			</tbody>
		</table>
		<?php
	}
		else
		{ ?>
			<blockquote>No results found for <?php echo escape($_POST['appname']); ?></blockquote>
		<?php
		}
} ?>


<h2>Find records based on system</h2>

<form method="post">
	<label for="appname">Application name</label>
	<input type="text" id="appname" name="appname">
	<input type="submit" name="submit" value="View results">
</form>
<br><br>
<a href="index.php">Back to home</a>

<?php include 'templates/footer.php'; ?>