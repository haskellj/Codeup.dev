<?php
	function pageController()
	{
		$data = [];

		// If player 1 is starting the game
		if(isset($_GET['score'])) {
				$score = $_GET['score'];
				$message = 'Game in Progess';
				$turn = "Player 1's Turn";
			if($_GET['score'] == 'miss') {
				$score = 0;
				$message = 'GAME OVER';
				$turn = 'Player 1 lost the rally!';
			}
		} else {
			$score = 0;
			$message = 'Hit the Ball to Begin';
			$turn = '';
		}
		if(!empty($_GET['player2'])) {
			$score2 = $_GET['player2'];
		} else {
			$score2 = 0;
		}

		$up = $score + 1;

		$data['score'] = $score;
		$data['score2'] = $score2;
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
	<form name="hit" method="get" action="pong.php">
		<input type="hidden" name="player1" value="<?php echo $up; ?>">
		<button type="submit" name="score" value="<?php echo $score2; ?>">Hit</button>
	</form>
	<br>
	<!-- Miss the ball -->
	<form name="miss" method="get">
		<button type="submit" name="score" value="miss">Miss</button>
	</form>
	<hr>
	<h2>Player 1 Score: <?php echo $score; ?></h2>
	<h2>Player 2 Score: <?php echo $score2; ?></h2>
	<hr>
	<h3><?php echo $turn; ?></h3>

</body>
</html>