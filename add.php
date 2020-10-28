<?php 
	
	include 'config/db_connect.php';

	$email = $title = $note = '';
	$errors = array('email' => '' , 'title' => '', 'note' => '' );
	if (isset($_POST['submit'])) {

		// Email
		if (empty($_POST['email'])) {
			$errors['email'] = 'Email is required <br />';
		}else{
			$email = $_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'email must be a valid email address! <br />';
			}
		}

		// Title
		if (empty($_POST['title'])) {
			$errors['title'] = 'Title is required <br />';
		}else{
			$title = $_POST['title'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
				$errors['title'] = 'Title must be letter and space only! <br />';
			}
		}

		// Note
		if (empty($_POST['note'])) {
			$errors['note'] = 'Note is required <br />';
		}else{
			$note = $_POST['note'];
			if (preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z]*)*$/', $note)) {
				$errors['note'] = 'Note must be a comma separated list! <br />';
			}
		}

		if (array_filter($errors)) {
			# code...
		}else {
			$title = mysqli_real_escape_string($con, $_POST['title']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$note = mysqli_real_escape_string($con, $_POST['note']);

			//create sql
			$sql = "INSERT INTO contacts(title, email, note) VALUES('$title', '$email', '$note')";

			//save to db and check
			if (mysqli_query($con, $sql)) {
				header('Location: index.php');
			} else {
				echo "query error: " . mysqli_error($con);
			}

		}
	}
?>

<?php include 'commons/header.php'; ?>

<section class="container grey-text">
	<h4 class="center">Please fill in the form!</h4>
	<!-- <form class="white" action="add.php" method="POST"> -->
	<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" placeholder="Email...">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>" placeholder="Title...">
		<div class="red-text"><?php echo $errors['title']; ?></div>
		<input type="text" name="note" value="<?php echo htmlspecialchars($note) ?>" placeholder="Note...">
		<div class="red-text"><?php echo $errors['note']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn contact z-depth-0">
		</div>
	</form>
</section>

<?php include 'commons/footer.php'; ?>