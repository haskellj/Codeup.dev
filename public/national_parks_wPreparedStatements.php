<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');

	require '../db_connect.php';
	require '../Input.php';

	// Array to hold user input in case of errors
	$savedInput = ['parkName'=>'', 'parkState'=>'', 'areaInAcres'=>'', 'dateEstablished'=>'', 'aboutPark'=>''];
	// if there is data submited from form, save it to the array above
	if(isset($_POST['submit'])) {
  		$savedInput = array_replace($savedInput, $_POST);	// replace initial values of user input array with $_POST data
	}


	// initialize an array to catch all the generic errors, and another to hold any custom messages for display
	$errors = [];
	$errorMessages = ['park'=>'', 'state'=>'', 'area'=>'', 'description'=>'', 'date'=>''];


	// Retrieve and sanitize user input into 'Add a Park' form, retrieve and display any errors that occur
	if (!empty($_POST)) {
		
		try {
			
			$newPark = Input::getString('parkName', 3, 50);
		
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['park'] = "A key was not provided";
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['park'] = "Key $key must be a string.";
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['park'] = "Input must be a string.";
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['park'] = "Name must be between 3 and 50 characters long.";
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['park'] = "Park Name must be alphanumeric.";
		}

		try {
			
			$newState = Input::getString('parkState', 2, 14);
		
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['state'] = "A key was not provided";
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['state'] = "Key $key must be a string.";
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['state'] = "Input must be a string.";
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['state'] = "State must be between 2 and 14 characters long.";
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['state'] = "State cannot contain numbers or symbols.";
		}

		try {
		
			$newArea = !empty($_POST['areaInAcres']) ? Input::getNumber('areaInAcres') : 0;
		
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['area'] = "A key was not provided";
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['area'] = $e->getMessage();
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['area'] = "Area must be a number.";
		}

		try {
			
			$newDesc = Input::getString('aboutPark', 1, 500);
		
		} catch (OutOfRangeException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['description'] = "A key was not provided";
		} catch (InvalidArgumentException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['description'] = "Key $key must be a string.";
		} catch (DomainException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['description'] = "Input must be a string.";
		} catch (LengthException $e) {
			$errors[] = $e->getMessage();
			$errorMessages['description'] = "Description must be less than 500 characters long.";
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
			$errorMessages['description'] = "Park Description must be alphanumeric.";
		}

		try {
			// getDate() re-formats the user inputted date to the correct format, using PHP library functions, before passing to MySQL 
			// If date field is left blank by the user, it will default to today's date
			$newDate = Input::getDate('dateEstablished');

		} catch (Exception $e) {
			$errors[] = $message = $e->getMessage();
			$errorMessages['date'] = $message;
			// echo "<script type='text/javascript'>alert('$message');</script>";
		}
	

		// If no errors occur, go ahead and insert the form into the database
		if (empty($errors)) {

			$userInput = "INSERT INTO national_parks (name, location, date_established, area_in_acres, description)
							VALUES (:name, :location, :date_est, :area, :description)";
			$insert = $dbc->prepare($userInput);

			$insert->bindValue(':name', $newPark, PDO::PARAM_STR);
			$insert->bindValue(':location', $newState, PDO::PARAM_STR);
			$insert->bindValue(':date_est', $newDate, PDO::PARAM_STR);
			$insert->bindValue(':area', $newArea, PDO::PARAM_STR);
			$insert->bindValue(':description', $newDesc, PDO::PARAM_STR);
			$insert->execute();
		}
	}

	// Pagination logic for links below table of parks
	$totalParks = $dbc->query("SELECT count(*) FROM national_parks")->fetchColumn();
	$perPage = (isset($_GET['per-page'])) ? (int)$_GET['per-page'] : 4;
	$totalPages = ceil($totalParks / $perPage);

	if (!isset($_GET['page']) || $_GET['page'] < 0 || !is_numeric($_GET['page']) || $_GET['page'] > $totalPages) {
		$page = 1;
	} else {
			$page = (int)$_GET['page'];
		}

	$offset = ($page > 1) ? $page * $perPage - $perPage : 0;
	$next = $page + 1;
	$previous = $page - 1;

	$query = "SELECT * FROM national_parks LIMIT :perPage OFFSET :offset";
	$parks = $dbc->prepare($query);
	$parks->bindValue(':perPage', $perPage, PDO::PARAM_INT);
	$parks->bindValue(':offset', $offset, PDO::PARAM_INT);
	$parks->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Querying Database w/ User Input</title>
	<style>
		table {
			margin-left: auto;
			margin-right: auto;
		}
		#pageControls {text-align: center;}
		thead {color:green;}
		tbody {color:blue;}
		tfoot {color:red;}

		table, th, td, #form {
		    border: 1px solid black;
		}

		.error {
			color: red;
			font-weight: bold;
		}
	</style>
</head>
<body>

	<!------------------- Table Displaying Parks -------------------->
	<table>
		<thead>
			<th>Name</th>
			<th>Location</th>
			<th>Date Established</th>
			<th>Area (in acres)</th>
			<th>Park Description</th>
		</thead>
		<tbody>
			<? foreach($parks as $park): ?>
				<tr>
				<td> <?= $park['name']; ?></td>
				<td> <?= $park['location']; ?> </td>
				<td> <?= $park['date_established']; ?></td>
				<td> <?= $park['area_in_acres']; ?></td>
				<td> <?= $park['description']; ?></td>
				</tr>
			<?endforeach; ?>
		</tbody>
	</table>
	<br>

	<!------------------ Pagination Buttons/Links ------------------>
	<div id="pageControls">
		<!-- Previous Button -->
		<?php if ($page > 1) { ?>
			<a href="national_parks_wPreparedStatements.php?page=<?php echo $previous; ?>&per-page=<?php echo $perPage; ?>">Previous</a>
		<?php } ?>
		
		<!-- Links for individual Pages -->
		<?php for($i = 1; $i <= $totalPages; $i++){ ?>
			<?php if ($page == $i) { ?>
				<?php echo $i; ?>
			<?php } else { ?>
				<a href="national_parks_wPreparedStatements.php?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a>
			<?php } ?>
		<?php } ?>
		
		<!-- Next Button -->
		<?php if ($page < $totalPages) { ?>
			<a href="national_parks_wPreparedStatements.php?page=<?php echo $next; ?>&per-page=<?php echo $perPage; ?>">Next</a>
		<?php } ?>
	</div>
	<br>

	<!----------------------- Form Field to Add a New Park ---------------------->
	<div id='form'>
		<h2>Add a Park</h2>
		<form id="addPark" method="POST" action="#addPark">
			<p>
			<input type='text' id='name' name='parkName' value="<?= $savedInput['parkName']; ?>" placeholder='Park Name' required>
				<span class="error">* <?= $errorMessages['park'] ?></span>
			</p>
			<p>
			<input type='text' id='location' name='parkState' value="<?= $savedInput['parkState']; ?>" placeholder="State where located" required> 
				<span class="error">* <?= $errorMessages['state'] ?></span>
			</p>
			<p>
			<input type='text' id='date' name='dateEstablished' value="<?= $savedInput['dateEstablished']; ?>" placeholder='Date established'> 
				<span class="error"><?= $errorMessages['date'] ?></span>
			</p>
			<p>
			<input type='text' id='area' name='areaInAcres' value="<?= $savedInput['areaInAcres']; ?>" placeholder='Area (in acres)'> 
			<span class="error"><?= $errorMessages['area'] ?></span>		
			</p>
			<textarea type='text' id='description' name='aboutPark' rows='10' cols='125' placeholder= 'Description of park' required><?= $savedInput['aboutPark']; ?></textarea> 
				<span class="error">* <?= $errorMessages['description'] ?></span>
			<br>		
			<input type='submit' name="submit">
			<h6>* indicates a required field</h6>
		</form>
	</div>
</body>
</html>