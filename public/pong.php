<?php
	function pageController()
	{
		$data = [];

		// If player 1 started the game
		if(isset($_GET['score'])) {
				$score = $_GET['score'];
				$message = 'Game in Progess';
				$turn = "Player 2's Turn";
			if($_GET['score'] == 'miss') {
				$score = 0;
				$message = 'GAME OVER';
				$turn = 'Player 2 lost the rally!';
			}
		} else {
			$score = 0;
			$message = 'Hit the Ball to Begin';
			$turn = '';
		}	
		if(!empty($_GET['player1'])) {
			$score1 = $_GET['player1'];
		} else {
			$score1 = 0;
		}

		$up = $score + 1;

		$data['score'] = $score;
		$data['score1'] = $score1;
		$data['up'] = $up;
		$data['message'] = $message;
		$data['turn'] = $turn;

		return $data;
	}
	extract(pageController());
?>

<!DOCTYPE html>
<html>
<head>
	<title>GET Request Exercise</title>
	<style>
		body {
			text-align: center;
		}

		h1 {
			color: red;
		}

		h2 {
			color: blue;
		}

		h3 {
			color: green;
		}
	</style>
</head>
<body>
	<!-- Display game status: 'in progress' or 'game over' -->
	<h1><?php echo $message; ?></h1>

	<!-- Hit the ball -->
	<form name="hit" method="get" action="ping.php">
		<input type="hidden" name="player2" value="<?php echo $up; ?>">
		<button type="submit" name="score" value="<?php echo $score1; ?>">Hit</button>
	</form>
	<br>
	<!-- Miss the ball -->
	<form name="miss" method="get">
		<button type="submit" name="score" value="miss">Miss</button>
	</form>
	<hr>
	<h2>Player 1 Score: <?php echo $score1; ?></h2>
	<h2>Player 2 Score: <?php echo $score; ?></h2>
	<hr>
	<h3><?php echo $turn; ?></h3>

</body>
</html>