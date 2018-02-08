<?php
	include_once 'dependencies.php';
?>

<footer class="footer position-absolute text-center py-4 px-4">
	<div class="container">
		<a class="footer-links" href='contact.php'>Kontakt</a> | <a class="footer-links" href='imprint.php'>Impressum</a> | <a class="footer-links" href='dataProtection.php'>Datenschutz</a>
	</div>
	<a href="#cd-top-link" class="cd-top"><i class='fas fa-angle-double-up fa-2x'> </i></a>
</footer>

<?php echo $footer_dependencies; ?>

<!-- Code for the cookie plugin -->
<script type="text/javascript">
	window.cookieconsent_options = {
		message: 'Diese Website nutzt Cookies, um bestmögliche Funktionalität bieten zu können.',
		dismiss: 'Verstanden',
		learnMore: 'Mehr Infos',
		link: 'datenschutz.php',
		theme: 'light-floating'
	};
</script>
<script type="text/javascript" src="../vendor/cookies/script.js"></script>

<!--Script for the Confirmation Modal -->
<script language="JavaScript" type="text/javascript">
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
</script>

</div> <!--End of the page-content-wrapper(see Header)-->
