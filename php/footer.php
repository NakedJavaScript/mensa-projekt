<?php
	include_once 'dependencies.php';
?>

	<footer class="footer">
      <div class="container">
        <a href='kontakt.php'>Kontakt</a> | <a href='impressum.php'>Impressum</a> | <a href='datenschutz.php'>Datenschutz</a>
	  	</div>
			<a href="#cd-top-link" class="cd-top"><i class='fas fa-angle-double-up fa-2x'> </i></a>
  </footer>

	<?php echo $footer_dependencies; ?>

	<!-- Start Cookie Plugin -->
	<!-- src: http://website-tutor.com/cookie-plugin-script/ -->
	<script type="text/javascript">
		window.cookieconsent_options = {
			message: 'Diese Website nutzt Cookies, um bestmögliche Funktionalität bieten zu können.',
			dismiss: 'Verstanden',
			learnMore: 'Mehr Infos',
			link: 'datenschutz.php',
			theme: 'light-floating'
		};
	</script>
	<script type="text/javascript" src="//s3.amazonaws.com/valao-cloud/cookie-hinweis/script.js"></script>
	<!-- Ende Cookie Plugin -->

</div> <!--Ende vom PagecontentWrapper(siehe Header)-->
