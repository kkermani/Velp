<?php
	$query = 'SELECT id, genres, original_title,poster_path FROM moviedb';
	if (isset($_GET["filter"])) {
		switch($_GET["filter"]) {
			case "comedy":
			$query = 'SELECT id, genres, original_title,poster_path FROM moviedb WHERE genres like "%comedy%"';
			break;
			case "drama":
			$query = 'SELECT id, genres, original_title,poster_path FROM moviedb WHERE genres like "%drama%"';
			break;
			case "action":
			$query = 'SELECT id, genres, original_title,poster_path FROM moviedb WHERE genres like "%action%"';
			break;
			case "newest":
			$query = 'SELECT id, genres, original_title,poster_path,release_date FROM moviedb ORDER BY release_date DESC';
			break;
			case "trending":
			$query = 'SELECT id, genres, original_title,poster_path,popularity FROM moviedb ORDER BY popularity DESC';
			break;
			case "rating":
			$query = 'SELECT id, genres, original_title,poster_path,vote_count FROM moviedb ORDER BY vote_count DESC';
			break;
			case "shortest":
			$query = 'SELECT id, genres, original_title,poster_path,runtime FROM moviedb ORDER BY runtime ASC';
			break;
			
			default:
			break;
			
		}
	}
?>

<!DOCTYPE html>

<html lang="en">

	<head>
		<!--Charset-->
		<meta charset="utf-8">
	
		<!--Viewport-->
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">

		<!--Icons-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!--Stylesheets-->
		<link href="css/normalize.css" rel="stylesheet">
		<link href="css/browse.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/flexbox.css" rel="stylesheet">

		<title>
			Browse
		</title>
		
	<head>

	<body>

	<!--Navigation-->
	<?php
		include_once "include/header.php";
	?>

	<div class="intro">
		<h2>Browse to find and select your favourite movies</h2>
	</div>
	
		<?php 
		function filterSelection($f) {
			switch($f) {
				case 'new':
				header('Location: ./browse.php?filter=newest');
				break;
				case 'rating':
				header('Location: ./browse.php?filter=rating');
				break;
				case 'shortest':
				header('Location: ./browse.php?filter=shortest');
				break;
				case 'trending':
				header('Location: ./browse.php?filter=trending');
				break;
				default:
				header('Location: ./browse.php');
				break;
				
				
			}
		}

		if(array_key_exists('newBtn', $_POST)) {
			filterSelection('new');
		} elseif (array_key_exists('rating', $_POST)) {
			filterSelection('rating');
		} elseif (array_key_exists('trending', $_POST)) {
			filterSelection('trending');
		} elseif (array_key_exists('shortest', $_POST)) {
			filterSelection('shortest');
		} 
		?>
	
	<div class="container filterBtn" id="myBtnContainer">
		<form method="POST">
		<h2>Sort</h2>
		<button type="submit" class="btn" onclick="filterSelection('all')">all</button>
		<button type="submit" class="btn" name="newBtn"> Newest</button>
		<button type="submit" class="btn" name="rating"> Highest Rating</button>
		<button type="submit" class="btn" name="shortest"> Shortest</button>
		<button type="submit" class="btn" name="trending"> Trending</button>
		</form>
	</div>

	<div class="container">
		<?php
		
		//API Key
		$movieDbUrl = "https://z4vrpkijmodhwsxzc.stoplight-proxy.io/3/movie/";
		$token = "?api_key=3f36afe25dfd9dadde3e0c9bd458f64b";

		$tmp = '[{"id": 16, "name": "Animation"}, {"id": 35, "name": "Comedy"}, {"id": 10751, "name": "Family"}]';

		//$sql = "SELECT id, genres, original_title,poster_path FROM moviedb";
		
		$result = $dbc->query($query);
		$rowCount = 0;
		$curl = curl_init();
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$genre = json_decode(str_replace("'",'"',$row["genres"]),true);
				$genres = '';
				foreach ($genre as $g) {
					$genres .= $g["name"].", ";
				}
				$genres = substr($genres,0,-2);

				curl_setopt_array($curl, array(
					CURLOPT_URL => $movieDbUrl . $row["id"] . $token,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => array(
						"cache-control: no-cache"
					),
				));

				//$response = curl_exec($curl);
				//$err = curl_error($curl);
				//$response = json_decode($response, true);
				//var_dump($response);
				$imgPath = "https://image.tmdb.org/t/p/w500" . $row["poster_path"];


				echo '<div class="box">';
				echo '<div class="imgBox">';
				echo '<img src="' . $imgPath . '" alt="picture 1" width="250px" height="300px">';
				echo "</div>";
					echo '<div class="details">';
						echo '<div class="contents">';
							echo '<h2>' . " - " . $row["original_title"] . '</h2>';
							echo '<p>' . $genres . '</p>';
						echo "</div>";
						echo '<button class="btn btn1">Star</button>
						<button class="btn btn2">Comment</button>';
					echo "</div>";
				echo "</div>";
				$rowCount += 1;
				if ($rowCount > 3) {
					$rowCount = 0;
					//echo "<br><br><br>";
				}

			}
			curl_close($curl);
		} else {
			echo "0 results";
		}

		?>

		<!--Footer-->
		<?php
			include_once "include/footer.php";
		?>

	</body>

</html>
