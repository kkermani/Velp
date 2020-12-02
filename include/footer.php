<!--Footer-->

<!-- Took a little help from online resource: https://tutorialzine.com/-->

<footer class="footer-distributed">

	<div class="footer-left">

		<h3 class="logoFooter">VELP</h3>

		<p class="footer-links textFooter">
		
			<a href="index.php">Home</a>
			|
			<a href="account.php">Account</a>
			|
			<a href="favorites.php">Favorites</a>
		</p>

		<p class="footer-company-name logoFooter">VELP &copy; 2020</p>
		
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
			<p><a href="mailto:info@velp.com" class="emailColor">info@velp.com</a></p>
		</div>

	</div>

	<div class="footer-right textFooter">

		<p class="footer-company-about">
			<span>About us</span>
			
			Velp, the ultimate movie review website where you can select your favorite movie and review them.

		</p>

		<div class="footer-icons">

			<a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
			<a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
			<a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>

		</div>

	</div>

</footer>

<?php

	//Close Database Connection
	$dbc->close();
?>