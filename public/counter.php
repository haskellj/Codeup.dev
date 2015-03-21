<?php
	function pageController()
	{
		$data = [];

		// GETs in the PHP retrieve data from the url that were thrown up by GETs in the html
		// If the GET['counter'] is not empty, then retrieve its value from the url and set it as $count
		// otherwise, $count = 0
		$count = (!empty($_GET['counter'])?$_GET['counter']:0);
		$up = $count + 1;
		$down = $count - 1;

		//BUILD DATA ARRAY
		$data['counter'] = $count;
		$data['up'] = $up;
		$data['down'] = $down;

		return $data;	

	}
	// {
	// 	// Initialize an empty array
	// 	$data = [];

	// 	// Counter should initially be zero
	// 	if(empty($_GET['direction'])) {
	// 		$counter = 0;
	// 	} else {
	// 		$counter = $_GET['counter'];
	// 	}
	// 	
	// 	$data['counter'] = $counter;
	// 	return $data;	// should be an array of $data = ['counter' => int($counter)]
	// }


	extract(pageController());

?>

<!DOCTYPE html>
<html>
<head>
	<title>GET Request</title>
	<style>
		body {
			text-align: center;
		}
	</style>
</head>

<body>
	<h1>Welcome to the GET Request exercise</h1>
	<!-- h2 shows current counter value -->
	<!-- keep an eye on the url in the browser as you click the links -->
	<h2>The current count is <?php echo $counter ?></h2>

	<!-- The ? enacts the GET request. Each equation following the ? represents the key => value of the GET array -->
	<!-- For example: ?direction=up means $_GET['direction'] = 'up' -->
	<!-- GETs located in the html throw data up to the url to be stored -->
	<!-- Up link -->
	<!-- <a href="?direction=up&counter=<?php echo $counter + 1; ?>">UP</a><br><br> -->

	<!-- Down link -->
	<!-- <a href="?direction=down&counter=<?php echo $counter - 1; ?>">DOWN</a> -->
		


	<!-- The form method enacts the GET request. The button 'name' and 'value' represent the key => value of the GET array -->
	<!-- For example: name='counter' value='5' means $_GET['counter'] = '5' -->
	<!-- GETs located in the html throw data up to the url to be stored -->
	<!-- Up button -->	
	<form name = "up" method="get">
		<button type="submit"  name="counter" value="<?php echo $up; ?>">Up</button>
	</form>
	<!-- Down button -->
	<form name = "down" method="get">
		<button type="submit"  name="counter" value="<?php echo $down; ?>">Down</button>
	</form>



</body>
</html>