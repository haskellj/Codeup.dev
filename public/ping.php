<?php
	function pageController()
	{
		$data = [];

		// If player 1 is starting the game
		if(!empty($_GET['score'])) {
				$score = $_GET['score'];
				$message = 'Game in Progess';
			if($_GET['score'] == 'miss') {
				$score = 0;
				$message = 'GAME OVER';
			}
		} else {
			$score = 0;
			$message = 'Hit the Ball to Begin';
		}

		$up = $score + 1;

		$data['score'] = $score;
		$data['up'] = $up;
		$data['message'] = $message;

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
	</style>
</head>
<body>
	<!-- Display game status: 'in progress' or 'game over' -->
	<h1><?php echo $message; ?></h1>

	<!-- Hit the ball -->
	<form name="hit" method="get" action="pong.php">
		<input type="hidden" name="player1" value="active">
		<button type="submit" name="score" value="<?php echo $up; ?>">Hit</button>
	</form>
	<hr>
	<!-- Miss the ball -->
	<form name="miss" method="get">
		<button type="submit" name="score" value="miss">Miss</button>
	</form>

	<h2>Player 1 Score: <?php echo $score; ?></h2>

</body>
</html>