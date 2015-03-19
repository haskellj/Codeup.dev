<?php
	$adjectives = ['blue', 'happy', 'indifferent', 'hairy', 'shitty', 'flat', 'curvy', 'bald', 'bubbly', 'square', 'soggy'];
	$nouns = ['shit', 'puppy', 'rainbow', 'puddle', 'snowman', 'duck', 'bee', 'flower', 'palm', 'chihuahua', 'html'];

	function randomName($adj, $noun)
	{
		$aKey = array_rand($adj);
		$randAdj = $adj[$aKey];
		$nKey = array_rand($noun);
		$randNoun = $noun[$nKey];

		return $randAdj." ".$randNoun;
	};
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP/HTML Mixed</title>
	<style>
		body {
			text-align: center;
		}
		h2 {
			margin-left: auto;
			margin-right: auto;
			font-weight: bold;
			color: blue;
			width: 200px;
			box-shadow: 2px 2px 4px #666;
		}
	</style>
</head>
<body>
	<h1>Your server name is:</h1>
	<h2><?php echo randomName($adjectives, $nouns); ?></h2>
</body>
</html>