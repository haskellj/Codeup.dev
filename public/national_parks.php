<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');

	require '../db_connect.php';

	$totalParks = $dbc->query("SELECT count(*) FROM national_parks")->fetchColumn();
	$perPage = (isset($_GET['per-page'])) ? (int)$_GET['per-page'] : 4;
	$totalPages = ceil($totalParks / $perPage);
	
	$page = (isset($_GET['page']) && $_GET['page'] <= $totalPages) ? (int)$_GET['page'] : 1;
	$offset = ($page > 1) ? $page * $perPage - $perPage : 0;
	$next = $page + 1;
	$previous = $page - 1;

	$stmt = $dbc->query("SELECT * FROM national_parks LIMIT {$perPage} OFFSET {$offset}");
	print_r($stmt->fetchAll(PDO::FETCH_ASSOC));




?>

<!DOCTYPE html>
<html>
<head>
	<title>Querying Database</title>
	<style>
		a.disabled {
			color: grey;
			text-decoration: none;
		}

	</style>
</head>
<body>
	<!-- Previous Button -->
	<?php if ($page > 1) { ?>
		<a href="national_parks.php?page=<?php echo $previous; ?>&per-page=<?php echo $perPage; ?>">Previous</a>
	<?php } ?>
	<!-- Links for individual Pages -->
	<?php for($i=1; $i<=$totalPages; $i++){ ?>
		<a href="national_parks.php?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a>
	<?php } ?>
	<!-- Next Button -->
	<?php if ($page < $totalPages) { ?>
		<a href="national_parks.php?page=<?php echo $next; ?>&per-page=<?php echo $perPage; ?>">Next</a>
	<?php } ?>


</body>
</html>