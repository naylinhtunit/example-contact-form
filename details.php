<?php  
	
	include 'config/db_connect.php';

	//delete
	if (isset($_POST['delete'])) {
		$id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);

		$sql = "DELETE FROM contacts WHERE id = $id_to_delete";

		if (mysqli_query($con, $sql)) {
			//success
			header('Location: index.php');
		}else {
			//failer
			echo 'query error: ' . mysqli_error($con);
		}
	}

	//check GET request id parameter
	if (isset($_GET['id'])) {
		$id = mysqli_real_escape_string($con, $_GET['id']);

		//make sql
		$sql = "SELECT * FROM contacts WHERE id = $id";

		//get the query result
		$result = mysqli_query($con, $sql);

		//fetch result in array format
		$contact = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($con);
	}

?>

<?php include 'commons/header.php'; ?>
<div class="container center grey-text">
	<?php if ($contact): ?>
		<h4><?php echo htmlspecialchars($contact['title']); ?></h4>
		<p><?php echo htmlspecialchars($contact['email']); ?></p>
		<h5><?php echo htmlspecialchars($contact['note']); ?></h5>
		<p><?php echo date($contact['created_at']); ?></p>

		<!-- Delete form -->
		<form action="details.php" method="POST">
			<input type="hidden" name="id_to_delete" value="<?php echo $contact['id']; ?>">
			<input type="submit" name="delete" value="Delete" class="btn contact z-depth-0">
		</form>
	<?php else: ?>
		<h5>No, such contact exit!</h5>
	<?php endif; ?>
</div>
<?php include 'commons/footer.php'; ?>