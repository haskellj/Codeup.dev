<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'parks_db');
	define ('DB_USER', 'parks_user');
	define ('DB_PASS', 'password');

	require 'db_connect.php';

	$emptyTable = 'TRUNCATE TABLE national_parks';
	$dbc->exec($emptyTable);

	$parks = [
		['name'=>'Acadia', 			'location'=>'Maine', 			'date'=>'1919-02-26', 'area'=>47389.67,		'description'=>'Covering most of Mount Desert Island and other coastal islands, Acadia features the tallest mountain on the Atlantic coast of the United States, granite peaks, ocean shoreline, woodlands, and lakes. There are freshwater, estuary, forest, and intertidal habitats.'],
		['name'=>'American Samoa', 	'location'=>'American Samoa', 	'date'=>'1988-10-31', 'area'=>9000,			'description'=>'The southernmost national park is on three Samoan islands and protects coral reefs, rainforests, volcanic mountains, and white beaches. The area is also home to flying foxes, brown boobies, sea turtles, and 900 species of fish.'],
		['name'=>'Arches', 			'location'=>'Utah', 			'date'=>'1929-04-12', 'area'=>76518.98,		'description'=>'This site features more than 2,000 natural sandstone arches, including the famous Delicate Arch. In a desert climate, millions of years of erosion have led to these structures, and the arid ground has life-sustaining soil crust and potholes, which serve as natural water-collecting basins. Other geologic formations are stone columns, spires, fins, and towers.'],
		['name'=>'Badlands', 		'location'=>'South Dakota', 	'date'=>'1978-11-10', 'area'=>242755.94,	'description'=>'The Badlands are a collection of buttes, pinnacles, spires, and grass prairies. It has the world\'s richest fossil beds from the Oligocene epoch, and the wildlife includes bison, bighorn sheep, black-footed ferrets, and swift foxes.'],
		['name'=>'Big Bend', 		'location'=>'Texas', 			'date'=>'1944-06-12', 'area'=>801163.21,	'description'=>'Named for the prominent bend in the Rio Grande along the US–Mexico border, this park encompasses a large and remote part of the Chihuahuan Desert. Its main attraction is backcountry recreation in the arid Chisos Mountains and in canyons along the river. A wide variety of Cretaceous and Tertiary fossils as well as cultural artifacts of Native Americans also exist within its borders.'],
		['name'=>'Biscayne', 		'location'=>'Florida', 			'date'=>'1980-06-28', 'area'=>172924.07,	'description'=>'Located in Biscayne Bay, this park at the north end of the Florida Keys has four interrelated marine ecosystems: mangrove forest, the Bay, the Keys, and coral reefs. Threatened animals include the West Indian Manatee, American crocodile, various sea turtles, and peregrine falcon.'],
		['name'=>'Carlsbad Caverns','location'=>'New Mexico', 		'date'=>'1930-05-14', 'area'=>46766.45,		'description'=>'Carlsbad Caverns has 117 caves, the longest of which is over 120 miles (190 km) long. The Big Room is almost 4,000 feet (1,200 m) long, and the caves are home to over 400,000 Mexican Free-tailed Bats and sixteen other species. Above ground are the Chihuahuan Desert and Rattlesnake Springs.'],
		['name'=>'Channel Islands', 'location'=>'California', 		'date'=>'1980-03-05', 'area'=>249561,		'description'=>'Five of the eight Channel Islands are protected, and half of the park\'s area is underwater. The islands have a unique Mediterranean ecosystem originally settled by the Chumash people. They are home to over 2,000 species of land plants and animals, and 145 are unique to them, including the island fox. Professional ferry services offer transportation to the islands from the mainland.'],
		['name'=>'Denali', 			'location'=>'Alaska', 			'date'=>'1917-02-26', 'area'=>4740911.72,	'description'=>'Centered around Mount McKinley, the tallest mountain in North America, Denali is serviced by a single road leading to Wonder Lake. McKinley and other peaks of the Alaska Range are covered with long glaciers and boreal forest. Wildlife includes grizzly bears, Dall sheep, caribou, and gray wolves.'],
		['name'=>'Dry Tortugas', 	'location'=>'Florida', 			'date'=>'1992-10-26', 'area'=>64701.22,		'description'=>'The islands of the Dry Tortugas, at the westernmost end of the Florida Keys, are the site of Fort Jefferson, a Civil War-era fort that is the largest masonry structure in the Western Hemisphere. With most of the park being remote ocean, it is home to undisturbed coral reefs and shipwrecks and is only accessible by plane or boat.'],
		['name'=>'Everglades', 		'location'=>'Florida', 			'date'=>'1934-05-30', 'area'=>1047116,		'description'=>'The Everglades are the largest subtropical wilderness in the United States. This mangrove ecosystem and marine estuary is home to 36 protected species, including the Florida panther, American crocodile, and West Indian manatee. Some areas have been drained and developed; restoration projects aim to restore the ecology.'],
		['name'=>'Grand Canyon', 	'location'=>'Arizona', 			'date'=>'1919-02-26', 'area'=>1217403.32,	'description'=>'The Grand Canyon, carved by the mighty Colorado River, is 277 miles (446 km) long, up to 1 mile (1.6 km) deep, and up to 15 miles (24 km) wide. Millions of years of erosion have exposed the colorful layers of the Colorado Plateau in countless mesas and canyon walls, visible from both the north and south rims, or from a number of trails that descend into the canyon itself.'],
		['name'=>'Grand Teton', 	'location'=>'Wyoming', 			'date'=>'1929-02-26', 'area'=>309994.66,	'description'=>'Grand Teton is the tallest mountain in the Teton Range. The park\'s historic Jackson Hole and reflective piedmont lakes teem with unique wildlife and contrast with the dramatic mountains, which rise abruptly from the sage-covered valley below.'],
		['name'=>'Haleakala', 		'location'=>'Hawaii', 			'date'=>'1916-08-01', 'area'=>29093.67,		'description'=>'The Haleakalā volcano on Maui features a very large crater with numerous cinder cones, Hosmer\'s Grove of alien trees, the Kipahulu section\'s scenic pools of freshwater fish, and the native Hawaiian Goose. It is home to the greatest number of endangered species within a U.S. National Park.'],
		['name'=>'Isle Royale', 	'location'=>'Michigan', 		'date'=>'1940-04-03', 'area'=>571790.11,	'description'=>'The largest island in Lake Superior is a place of isolation and wilderness. Along with its many shipwrecks, waterways, and hiking trails, the park also includes over 400 smaller islands within 4.5 miles (7.2 km) of its shores. There are only 20 mammal species on the entire island, though the relationship between its wolf and moose populations is especially unique.'],
		['name'=>'Joshua Tree', 	'location'=>'California', 		'date'=>'1994-10-31', 'area'=>789745.47,	'description'=>'Covering large areas of the Colorado and Mojave Deserts and the Little San Bernardino Mountains, this exotic desert landscape is populated by vast stands of the famous Joshua tree. Great changes in elevation reveal starkly contrasting environments including bleached sand dunes, dry lakes, rugged mountains, and maze-like clusters of monzogranite monoliths.'],
		['name'=>'Katmai', 			'location'=>'Alaska', 			'date'=>'1980-12-02', 'area'=>3674529.68,	'description'=>'This park on the Alaska Peninsula protects the Valley of Ten Thousand Smokes, an ash flow formed by the 1912 eruption of Novarupta, as well as Mount Katmai. Over 2,000 grizzly bears come here each year to catch spawning salmon. Other wildlife includes caribou, wolves, moose, and wolverines.'],

	];
	
	// Query and Prepare the database once, before the foreach loop
	$query = "INSERT INTO national_parks (name, location, date_established, area_in_acres, description)
				VALUES (:name, :location, str_to_date(:date_est, '%Y-%m-%d'), :area, :description)";
	$stmt = $dbc->prepare($query);
	
	foreach ($parks as $park) {	
		$stmt->bindValue(':name', $park['name'], PDO::PARAM_STR);
		$stmt->bindValue(':location', $park['location'], PDO::PARAM_STR);
		$stmt->bindValue(':date_est', $park['date'], PDO::PARAM_STR);
		$stmt->bindValue(':area', $park['area'], PDO::PARAM_STR);
		$stmt->bindValue(':description', $park['description'], PDO::PARAM_STR);
		$stmt->execute();

		echo "Inserted ID: ".$dbc->lastInsertId().PHP_EOL;
	}

