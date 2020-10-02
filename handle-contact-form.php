<?php
  if( $_SERVER['HTTP_REFERER'] != 'https://igarrido.es/en/contact.html' && $_SERVER['HTTP_REFERER'] != 'https://igarrido.es/es/contacto.html' ) {
    header("Location: https://igarrido.es/");
    die();
  }
  if( $_SERVER['HTTP_USER_AGENT'] != $_POST['ua'] || $_SERVER['REQUEST_METHOD'] != 'POST' ) {
    header("Location: https://igarrido.es/");
    die();
  }

  $prevCheck = unserialize( file_get_contents( 'handle-contact-form.data' ) );

  $check = array( $_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_TIME'] );
  file_put_contents( 'handle-contact-form.data', serialize($check) );

  if( $prevCheck != false ) {
    if( $prevCheck[0] == $check[0] && $check[1]-$prevCheck[1] <= 120 ) {
      http_response_code(503);
      header($_SERVER['SERVER_PROTOCOL'] + " 503 Service Unavailable");
      die();
    }
    if( $check[1]-$prevCheck[1] <= 60 ) {
      http_response_code(503);
      header($_SERVER['SERVER_PROTOCOL'] + " 503 Service Unavailable");
      die();
    }
  }

  //$lang = substr( $_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2 );
  $lang = substr( $_SERVER['HTTP_REFERER'], 20, 2 );

  $body = <<<"EOD"
<div>
<p>
Hola!
</p>
<p>
Alguien ha rellenado el formulario de contacto de tu página. Éstos son sus datos:
<ul>
<li><pre>Nombre: {$_POST['name']}</pre></li>
<li><pre>Email:  {$_POST['email']}</pre></li>
<li><pre>Tlf:    {$_POST['phone']}</pre></li>
<li><pre>Texto:  {$_POST['subject']}</pre></li>
</ul>
<hr/>
<ul>
<li><pre>User agent: {$_SERVER['HTTP_USER_AGENT']}</pre></li>
<li><pre>Language:   {$_SERVER['HTTP_ACCEPT_LANGUAGE']}</pre></li>
<li><pre>IP:         {$_SERVER['REMOTE_ADDR']}</pre></li>
</ul>
Pasa un buen día!
</p>
</div>
EOD;

  $firstc=(4*25)+(3*3);
  $headers = 'Content-Type: text/html;\r\ncharset="UTF-8"';
  $headers = array(
    'From' => chr($firstc).chr($firstc-pow(2,3)).chr(pow(2,6)).$_SERVER['HTTP_HOST'],
    'Content-Type' => 'text/html',
    'Charset' => 'UTF-8'
  );
  
  $retval = mail( chr($firstc).chr($firstc-pow(2,3)).chr(pow(2,6)).$_SERVER['HTTP_HOST'], 'Petición de contacto desde '.$_SERVER['HTTP_HOST'], $body, $headers );

  if( $lang == 'es' ) {
    if( $retval == true ) {
      $message = "Me ha llegado el mensaje. En breve contactaré contigo. ¡Gracias!";
    }
    else {
      $message = "No se ha podido registrar la petición. Inténtalo de nuevo más tarde.";
    }
    $pageTitle    = "Iván Garrido";
    $pageHeader   = "Iván Garrido - Contacto";
    $sectionTitle = "Nos ponemos en contacto";
    $back         = "Volver";
    $footerSocialNetworks = "Redes sociales:";
  }
  else {
    $lang = "en";
    if( $retval == true ) {
      $message = "Message sent successfully... Thank you!";
    }
    else {
      $message = "Message could not be sent...";
    }
    $pageTitle    = "Iván Garrido";
    $pageHeader   = "Iván Garrido - Contact";
    $sectionTitle = "Contact me!";
    $back         = "Go back";
    $footerSocialNetworks = "Social networks:";
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1/new.min.css" />
    <link rel="stylesheet" href="../css/pages.css" />
<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//mwa.igarrido.es/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
    <title><?php echo $pageTitle; ?></title>
  </head>
  <body>
    <header>
      <h1><?php echo $pageHeader; ?></h1>
    </header>
    <section>
      <article>
        <h2><?php echo $sectionTitle; ?></h2>
        <p><?php
          echo $message;
        ?></p>
        <a href="/<?php echo $lang; ?>/"><?php echo $back; ?></a>
      </article>
      <pre style="display:none;">
<?php
  var_dump( $prevCheck );
  var_dump( $check );
  var_dump( $_POST );
/*
  var_dump( $_SERVER );
  */
?>
      </pre>
    </section>
<!--
    <nav class="menu">
      <ul>
        <li>Fichero
            <div class="submenu"><div><ul><li>Blog</li><li>RSS</li></ul></div></div>
        </li>
        <li>Programador
            <div class="submenu"><div><ul>
                <li>Trayectoria</li>
                <li><a href="proyectos-personales.html">Side projects</a></li>
                <li>Tecnologías</li>
            </ul></div></div>
        </li>
        <li>Profesor
            <div class="submenu"><div><ul>
                <li>Clases</li>
                <li><a href="programacion.html">Conocimientos</a></li>
            </ul></div></div>
        </li>
        <li>Contacto
            <div class="submenu"><div><ul><li>Redes sociales</li><li>Formulario</li></ul></div></div>
        </li>
    </ul>
    </nav>
-->
    <footer>
    <?php echo $footerSocialNetworks; ?>
      <ul>
        <li><a href="https://twitter.com/igarridoatwork"    target="_blank">Twitter</a></li>
        <li><a href="https://github.com/igarridomorillas"   target="_blank">GitHub</a></li>
        <li><a href="https://www.linkedin.com/in/igarrido/" target="_blank">Linkedin</a></li>
      </ul>
    </footer>
  </body>
</html>