<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');

	require '../db_connect.php';

	// Retrieve and sanitize user input into 'Add a Park' form
	if (isset($_POST['parkName']) && isset($_POST['parkState']) && isset($_POST['aboutPark'])) {
		$newPark = htmlspecialchars(strip_tags($_POST['parkName']));
		$newState = htmlspecialchars(strip_tags($_POST['parkState']));
		$newDate = isset($_POST['dateEstablished']) ? htmlspecialchars(strip_tags($_POST['dateEstablished'])) : '';
		$newArea = isset($_POST['areaInAcres']) ? htmlspecialchars(strip_tags($_POST['areaInAcres'])) : '';
		$newDesc = htmlspecialchars(strip_tags($_POST['aboutPark']));
	
		// Add to database with user input from the form
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


	$totalParks = $dbc->query("SELECT count(*) FROM national_parks")->fetchColumn();
	$perPage = (isset($_GET['per-page'])) ? (int)$_GET['per-page'] : 4;
	$totalPages = ceil($totalParks / $perPage);
	
	$page = (isset($_GET['page']) && $_GET['page'] <= $totalPages && $_GET['page'] > 0 && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;
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
	</style>
</head>
<body>
	<!-- Table Displaying Parks -->
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
	<div id="pageControls">
		<!-- Previous Button -->
		<?php if ($page > 1) { ?>
			<a href="national_parks.php?page=<?php echo $previous; ?>&per-page=<?php echo $perPage; ?>">Previous</a>
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
	<div id='form'>
		<h2>Add a Park</h2>
		<form method="POST" action="national_parks_wPreparedStatements.php">
			<p>
			<label for='name'>Name*</label><br>
			<input type='text' id='name' name='parkName' placeholder='Acadia' required>
			</p>
			<p>
			<label for='location'>State in which it's located*</label><br>
			<input type='text' id='location' name='parkState' placeholder='Maine' required>
			</p>
			<p>
			<label for='date'>Date established</label><br>
			<input type='text' id='date' name='dateEstablished' placeholder='1919-02-26'>
			</p>
			<p>
			<label for='area'>Area in acres</label><br>
			<input type='text' id='area' name='areaInAcres' placeholder='47389.67'>		
			</p>
			<label for='description'>Describe this park*</label><br>
			<textarea type='text' id='description' name='aboutPark' rows='10' cols='125' required></textarea><br>		
			<input type='submit'>
			<h6>* indicates a required field</h6>
		</form>
		
	</div>


</body>
</html>