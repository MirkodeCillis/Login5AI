<?php
require_once ("config.php");
require_once ("validateJWT.php");

if ($valid['valid'])
    $valid['values'] = json_decode(getter('http://myprocessing.altervista.org/scripts/elenco_articoli.php')) ;
else
    $valid['values'] = "Accesso Negato.";

print( json_encode($valid));

?>