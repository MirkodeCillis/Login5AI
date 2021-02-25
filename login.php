<?php
require_once ("config.php");

$email = $_POST['email'];
$password = addslashes( $_POST['password'] );
$password = hash_hmac( "sha256", $password, $secretKey);

$conn = new mysqli($host, $root, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Errore di connesione al server. ".$conn->connect_error);
}

$query = "select * from auth5ai where email='$email'";
$result = $conn->query($query);
//ESISTE L'UTENTE
if($result->num_rows == 1) {
    $query="SELECT * FROM auth5ai WHERE email='$email' and password='$password'";
    $result = $conn->query($query);

    //LA PASSWORD è CORRETTA
    if($result->num_rows == 1) {

        //INIZIO COSTRUZIONE HEADER
        $array_header = array(
            'alg' => "SHA256",
            'type' => "JWT"
        );
        $header = json_encode($array_header);
        //FINE COSTRUZIONE HEADER

        //ASSOCIAZIONE RISULTATI QUERY A $ROW
        $row = $result->fetch_object();

        $array_payload = array(
            'nome'  => $row->nome,
            'cognome'  => $row->cognome,
            'email'  => $row->email,
        );

        $payload = json_encode($array_payload);

        $unsignedtoken = base64_encode($header) . "." . base64_encode($payload);

        $signature = hash_hmac($array_header['alg'],  $unsignedtoken, $secretKey);

        $tokenjwt=base64_encode($header) . "." . base64_encode($payload) . "." . base64_encode($signature);

        $array_risultato= array(
            'id'  => 1,
            'messaggio'  => "Login effettuato con successo!",
            'value' => $tokenjwt,
        );

    }
    else {
        $array_risultato= array(
            'id'  => 2,
            'messaggio'  =>"Password errata",
        );
    }
}
else
{
    $array_risultato= array(
        'id'  => 0,
        'messaggio'  =>"Utente inesistente",
    );
}

print (json_encode($array_risultato));
?>