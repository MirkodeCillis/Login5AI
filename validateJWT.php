<?php
require_once ("config.php");

$tokenjwt = $_POST['jwt'];

//$tokenjwt="eyJhbGciOiJTSEEyNTYiLCJ0eXBlIjoiSldUIn0=.
//eyJub21lIjoidmluY2Vuem8iLCJjb2dub21lIjoiZGF2YW56byIsImVtYWlsIjoidi5kYXZhbnpvQHRpc2NhbGkuaXQifQ==.
//ODc2YTliMjhiMmIzOGZmMmM0NzE4ZTY2MTM3MGRjNWMzYzBkMTZmMDlhZWM3Yjk0NWFlODQxNjg3M2MzYWI5Mg==";

//print ($tokenjwt . "<br>");

$jwtseparato = explode(".", $tokenjwt);

$header = $jwtseparato[0];
//print ($header . "<br>");

$payload = $jwtseparato[1];
//print ($payload . "<br>");

//ATTENZIONE A QUESTO PEZZO
$firma = $jwtseparato[2];
//print ($firma . "<br>");

$unsignedtoken = $header . "." . $payload;

$signature=hash_hmac("SHA256",  $unsignedtoken, $secretKey);

$signatureb64 = base64_encode($signature);
//print ($signatureb64 . "<br>");
$valid = array(
    'valid' => ($signatureb64 == $firma)
);

?>