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
<<<<<<< HEAD

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
=======
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Fauna+One&display=swap" rel="stylesheet">
    <link href="css/browse.css" rel="stylesheet">

    <link rel="stylesheet" href="css/normalize.css">

    <!-- Took a little help from online resource: https://tutorialzine.com/-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="header">
    <div class="navcontainer">
        <nav>
            <input id="nav-toggle" type="checkbox">
            <div class="logo logoCo"><a href="index.html" class="logoCo"><strong>VELP</strong></a></div>
            <ul class="links">
                <li><a href="index.html">Home</a></li>
                <li><a href="browse.html">Browse</a></li>
                <li><a href="member.html">Account</a></li>
                <li><a href="account.html">Sign-up</a></li>

            </ul>
            <label for="nav-toggle" class="icon-burger">
                <span class=" c line"></span>
                <span class=" c line"></span>
                <span class=" c line"></span>
            </label>
        </nav>
    </div>
</div>


<div class="intro">

    <h2>Browse to find and select your favourite movies</h2>
</div>
<?php 
function filterSelection($f) {
	switch($f) {
		case 'new':
		header('Location: http://localhost/Velp/browse.php?filter=newest');
		break;
		case 'rating':
		header('Location: http://localhost/Velp/browse.php?filter=rating');
		break;
		case 'shortest':
		header('Location: http://localhost/Velp/browse.php?filter=shortest');
		break;
		case 'trending':
		header('Location: http://localhost/Velp/browse.php?filter=trending');
		break;
		default:
		header('Location: http://localhost/Velp/browse.php');
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
    <h2>Sort</h2>
	<form method="POST">
    <button type="submit" class="btn" onclick="filterSelection('all')">all</button>
    <button type="submit" class="btn" name="newBtn"> Newest</button>
    <button type="submit" class="btn" name="rating"> Highest Rating</button>
    <button type="submit" class="btn" name="shortest"> Shortest</button>
    <button type="submit" class="btn" name="trending"> Trending</button>
	</form>
</div>



<div class="container">
    <?php
    $movieDbUrl = "https://z4vrpkijmodhwsxzc.stoplight-proxy.io/3/movie/";
    $token = "?api_key=3f36afe25dfd9dadde3e0c9bd458f64b";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "moviedb";
    $tmp = '[{"id": 16, "name": "Animation"}, {"id": 35, "name": "Comedy"}, {"id": 10751, "name": "Family"}]';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
   // $sql = "SELECT id, genres, original_title,poster_path FROM moviedb";
    $result = $conn->query($query);
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
    $conn->close();
    ?>


    <footer class="footer-distributed">

        <div class="footer-left">

            <h3 class="logoFooter">VELP</h3>

            <p class="footer-links textFooter">
                <a href="index.html">Home</a>
                ·
                <a href="favourite.html">Favourites</a>
                ·
                <a href="account.html">Account</a>
                ·

            </p>

            <p class="footer-company-name logoFooter">VELP &copy; 2019</p>
        </div>

        <div class="footer-center textFooter">

            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>8884 140B Street</span>Surrey, BC, Canada</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+1(604)-240-1471</p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:shyamagalabadage@gmail.com" class="emailColor">info@velp.com</a></p>
            </div>

        </div>

        <div class="footer-right textFooter">

            <p class="footer-company-about">
                <span>About us</span>
                velp, the ultimate movie review website where you can select your favourite movie and review them

            </p>

            <div class="footer-icons">

                <a href="https://www.facebook.com/groups/98439537650"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/nperera17?s=20"><i class="fa fa-twitter"></i></a>
                <a href="https://ca.linkedin.com/in/nisha-perera-667b54130?trk=people-guest_people_search-card"><i
                        class="fa fa-linkedin"></i></a>


            </div>

        </div>

    </footer>


</body>

</html>

<!-- CITATIONS FOR IMAGES USED -->
<!-- IMAGES TAKEN FROM
https://www.zairazarotti.com/on-the-beauty-and-restlessness-of-solitude-a-layered-walnut-cake-with-italian-meringue-mascarpone-frosting-figs-and-salty-caramel/

https://www.justdial.com/Indore/Devs-Bakery-HIG-Colony/0731PX731-X731-140715132725-K2S4_BZDET

https://www.etsy.com/ca/listing/675734109/wedding-cake-topper-mr-and-mrs-hexagon

https://thefeedfeed.com/thelittleplantation/vegan-rhubarb-layer-cake

https://www.thekitchenmccabe.com/2018/12/06/paleo-caramel-custard-cake-toasted-meringue
/ -->
>>>>>>> master
