<?php
	include_once 'dependencies.php';
?>

	<footer class="footer">
      <div class="container">
        <a href='kontakt.php'>Kontakt</a> | <a href='impressum.php'>Impressum</a> | <a href='datenschutz.php'>Datenschutz</a>
	  	</div>
  </footer>

	<?php echo $footer_dependencies; ?>

	<!-- Start Cookie Plugin -->
	<script type="text/javascript">
		window.cookieconsent_options = {
		  message: 'Diese Website nutzt Cookies, um bestmögliche Funktionalität bieten zu können.',
		  dismiss: 'Verstanden',
		  learnMore: 'Mehr Infos',
		  link: 'datenschutz.php',
		  theme: 'dark-bottom'
		};
	</script>
	<script type="text/javascript" src="../vendor/valao-cloud/script.js"></script>
	<!-- Ende Cookie Plugin -->

</div> <!--Ende vom PagecontentWrapper(siehe Header)-->
