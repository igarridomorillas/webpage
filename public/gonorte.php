<?php
$eta = -hrtime(true);
echo "Abriendo GoNorte...\n";
//$html = file_get_contents('https://gonorteoncologia.com/');
/*
$html = file_get_contents('https://gonorteoncologia.com/noticias-cancer-genitourinario/');
$eta += hrtime(true);
echo "Han transcurrido " . ($eta/1e+6) . "msec.\n\n";

if( strpos($html, 'Nuestro homenaje a los profesionales sanitarios') ) {
	echo " - Encontrado título.\n";
}
if( strpos($html, 'href="https://gonorteoncologia.com/nuestro-homenaje-a-los-profesionales-sanitarios/"') ) {
	echo " - Encontrado enlace noticia\n";
}
 */
$list_url = array();
$list_url[] = 'https://gonorteoncologia.com/';
$list_url[] = 'https://gonorteoncologia.com/quienes-somos/';
$list_url[] = 'https://gonorteoncologia.com/proyectos-investigacion-tumores-genitourinarios/';
$list_url[] = 'https://gonorteoncologia.com/proyectos-investigacion-tumores-genitourinarios/';
$list_url[] = 'https://gonorteoncologia.com/actividades-formacion-tumores-genitourinarios/';
$list_url[] = 'https://gonorteoncologia.com/campanas-difusion-cancer-genitourinario/';
$list_url[] = 'https://gonorteoncologia.com/noticias-cancer-genitourinario/';
$list_url[] = 'https://gonorteoncologia.com/contacto/';

$list_url[] = 'https://gonorteoncologia.com/ensayos-clinicos-tumores-genitourinarios/';
$list_url[] = 'https://gonorteoncologia.com/hazte-socio/';
$list_url[] = 'https://gonorteoncologia.com/nuestro-homenaje-a-los-profesionales-sanitarios/';
$list_url[] = 'https://gonorteoncologia.com/proyectos-investigacion-tumores-genitourinarios/proyecto-covid-ren/';
$list_url[] = 'https://gonorteoncologia.com/proyectos-investigacion-tumores-genitourinarios/proyecto-urogallo/';
$list_url[] = 'https://gonorteoncologia.com/proyectos-investigacion-tumores-genitourinarios/proyecto-inmunomodulacion/';
$list_url[] = 'https://gonorteoncologia.com/proyectos-investigacion-tumores-genitourinarios/proyecto-gres/';
$list_url[] = 'https://gonorteoncologia.com/ensayos-clinicos-base-de-datos/';
$list_url[] = 'https://gonorteoncologia.com/contacto/gracias-form-ensayos-clinicos/';

$list_url[] = 'https://gonorteoncologia.com/contacto/gracias-form-grupos-trabajo/';
$list_url[] = 'https://gonorteoncologia.com/contacto/gracias-form-socios/';
$list_url[] = 'https://gonorteoncologia.com/portfolio/ejemplo/';
$list_url[] = 'https://gonorteoncologia.com/noticias/';
$list_url[] = 'https://gonorteoncologia.com/author/gnrt_20/';
$list_url[] = 'https://gonorteoncologia.com/contacto/gracias-contacto-general/';
$list_url[] = 'https://gonorteoncologia.com/politica-cookies/';
$list_url[] = 'https://gonorteoncologia.com/aviso-legal/';
$list_url[] = 'https://gonorteoncologia.com/politica-privacidad/';

$list_url[] = 'https://gonorteoncologia.com/feed/';
$list_url[] = 'https://gonorteoncologia.com/comments/feed/';
$list_url[] = 'https://gonorteoncologia.com/nuestro-homenaje-a-los-profesionales-sanitarios/feed/';

$index = 0;
while( $index < count($list_url) ) {
	$eta = -hrtime(true);
	echo $list_url[$index] . " ";
	$html = file_get_contents( $list_url[$index] );
	$eta += hrtime(true);
	echo '' . ($eta/1e+6) . "ms.\n";

	sleep( ($eta/1e+9) * 3 );

//	preg_match_all('/https:\/\/w*\.?gonorteoncologia.com\/[^)\'"#<]*/', $html, $list_new_url);
/*
	foreach( $list_new_url[0] as $url ) {
        	if( !in_array($url, $list_url) ) {
	                $list_url[] = $url;
        	}
	}
*/
	$index++;
}


echo "\n\n";
?>
