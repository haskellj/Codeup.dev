<?php
	$favoriteThings = ['Raindrops on roses', 'Whiskers on kittens', 'Bright copper kettles', 'Warm woolen mittens', 'Brown paper packages tied up with strings'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP/HTML Mixed</title>
	<style>
		html, body {
			text-align: center;
			margin: 0;
			padding: 0;
			background-color: #a0a0f0;
		}
		table, td {
			text-align: left;
			margin-top: 25px;
			margin-right: auto;
			margin-left: auto;
			border: 1px solid black;
		}
		#tableWrapper {
			width: 284px;
			margin-left: auto;
			margin-right: auto;
			background-color: #fff;
		}
		.grey {
			background-color: #aaa;
		}
		.hoverChange:hover {
			background-color: yellow;
		}
		h1 {
			text-align: center;
			background-color: #f0a0a0;
		}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="jquery-1.4.1.min.js"><\/script>')</script>
	<script src="jquery.raptorize.1.0.js"></script>
	<script type="text/javascript">
	     $(window).load(function() {
	          $('.myButton').raptorize()
	     });
	</script>
</head>
<body>
	<div id="tableWrapper">
		<table>
			<?php foreach($favoriteThings as $key => $thing){ ?>
				<?php if($key % 2 == 0){ ?>
					<tr class="hoverChange">
						<td><?php echo $thing; ?></td>
					</tr>
				<?php } else { ?>
					<tr class="grey">
						<td><?php echo $thing; ?></td>
					</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
	<h1>These are a few of my favorite things.....</h1>
	<button class="myButton">Click to see another</button>
</body>
</html>