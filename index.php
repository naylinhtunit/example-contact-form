<?php 
	
	include 'config/db_connect.php';

	//write query for all contacts
	$sql = 'SELECT * FROM contacts';

	//make query and get result
	$result = mysqli_query($con, $sql);

	//fetch the resulting rows as an array
	$contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($con);

?>
<?php include 'commons/header.php'; ?>
	<h4 class="center grey-text">Contact</h4>
	<div class="container">
		<div class="row">
			
			<?php foreach ($contacts as $contact): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($contact['title']); ?></h6>
							<div><?php echo htmlspecialchars($contact['email']); ?></div>
							<ul>
								<?php foreach (explode(',', $contact['note']) as $note): ?>
									<li><?php echo htmlspecialchars($note); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="contact-text" href="details.php?id=<?php echo $contact['id'] ?>">more info</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

			<?php if (count($contacts) >= 2): ?>
				<p>There are 2 or more contacts!</p>
			<?php else: ?>
				<p>There are less than 2 contacts</p>
			<?php endif; ?>
		</div>
	</div>
<?php include 'commons/footer.php'; ?>