<?php
	// Require or include statements are allowed here. All other code goes in the pageController function.

	/**
	 * The pageController function handles all processing for this page.
	 * @return array An associative array of data to be used in rendering the html view.
	 */
	function pageController()
	{
	    $adjectives = ['moist', 'blue', 'happy', 'indifferent', 'hairy', 'shitty', 'flat', 'curvy', 'bald', 'bubbly', 'square', 'soggy'];
		$nouns = ['shit', 'puppy', 'rainbow', 'puddle', 'snowman', 'duck', 'bee', 'flower', 'palm', 'chihuahua', 'html'];

		// Internal function to generate a random combination of the two arrays' elements as a single string.
		function randomName($adj, $noun)
		{
			$aKey = array_rand($adj);
			$randAdj = $adj[$aKey];
			$nKey = array_rand($noun);
			$randNoun = $noun[$nKey];

			return $randAdj." ".$randNoun;
		};

	    // Initialize an empty data array.
	    $data = array();

	    // Call an internal function within the pageController()
	    $output = randomName($adjectives, $nouns);

	    // Add data to be used in the html view.
	    $data['message'] = $output;

	    // Return the completed data array.
	    return $data;    
	}

	// Call the pageController function and extract all the returned array as local variables.
	extract(pageController());

	// Only use echo, conditionals, and loops anywhere within the HTML.
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
	<h2><?php echo $message; ?></h2>
</body>
</html>