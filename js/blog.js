/* Descripción : Control de la aplicación
 * Author      : @Fitorec
 * Fecha       : 2012/10/02 08:08:20
 * Licencia    : Dual GPL3/MIT
 */
!function ($) {
//Estilo al boton de comentario
$('input[type="submit"]').addClass('btn btn-large btn-primary');

//vamos a mover el banner.
$('#third').appendTo("#Topbanner");
//agregando fecha bonita
$(".entry-date").prettyDate({attribute: "datetime"});
$('.by-author').popover({'trigger':'hover'});

// compartir facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Compartir por twitter
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
// Compartir por G+
window.___gcfg = {lang: 'es-419'};
(function() {
	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/plusone.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();

//tooltip
$('img[title]').tooltip();
$('a[title]').tooltip();

/** colorBox */
$('.entry-content').find("a[href*='jpg']").colorbox();

// Soporte colorBox para las imagenes de las galerias
$(".gallery-item").find('a').colorbox({
rel: 'gallery-item',
href: function(){
    var url = $($(this).find('img')[0]).attr('src');
    return url.replace(/-150x150(\.[0-9a-z]+)/i, '$1');
}
});

// Soporte colorBox para las imagenes adjuntas
$('.entry-content').find("a[rel*='attachment']").colorbox({
href: function(){
    var url = $($(this).find('img')[0]).attr('src');
    url = url.replace(/-([0-9]+)x([0-9]+)(\.[0-9a-z]+)/i, '$3');
		console.log(url);
    return url;
}
});

$('p#copiarLink input').focus(
function(e) {
	$(this).select();
	e.preventDefault();
}).blur(
function() {
	if( $(this).attr('value') != $(this).attr('placeholder') )
		$(this).attr('value', $(this).attr('placeholder'));
});

/*************** Barra scroll ***********************/
// http://gazpo.com/2012/02/scrolltop/
$(window).scroll(function(){
	if ($(this).scrollTop() > 100) {
		$('.scrollup').fadeIn();
	} else {
		$('.scrollup').fadeOut();
	}
});
$('.scrollup').click(function(){
	$("html, body").animate({ scrollTop: 0 }, 600);
	return false;
}).tooltip({placement:'right'});

}(window.jQuery);


//////////////////////
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
