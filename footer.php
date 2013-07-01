<?php
/**
 * @package WordPress
 * @subpackage Min
 * @since Min 1.0
 */
?>
	</div><!-- #content-box -->

	<div id="footer" role="contentinfo" class="well">
		<?php get_sidebar( 'footer' ); ?>

		<div id="colophon">
			Desarrollado por
			<a href="http://mundosica.com">mundosica.com</a>

			<span class="generator-link">
				Funciona con <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'min' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'min' ); ?>">WordPress</a></span>
		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #container -->

<?php wp_footer(); ?>
<!-- boton subir -->
<a href="#" title=' Subir ' class="scrollup">Scroll</a>

<!-- compartir facebook -->
<div id="fb-root"></div>
<!-- seccion javascript aquí es mas rapido -->
<script type='text/javascript' src='<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery-1.9.1.min.js'></script>
<script type='text/javascript' src='<?php bloginfo( 'stylesheet_directory' ); ?>/js/bootstrap.min.js'></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.prettydate.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.prettydate-es.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/fokus.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/blog.js"></script>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://mundosica.com/piwik/" : "http://mundosica.com/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 13);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://mundosica.com/piwik/piwik.php?idsite=13" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
<script type="text/javascript">
$(function() {
		  $('.authorNumPost').tooltip({placement:'right'});
		  $('.postsByUser').find('li a').tooltip();
});
</script>
</body>

</html>
