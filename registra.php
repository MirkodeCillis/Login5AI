<?php
require_once ("config.php");

$email = $_POST['email'];
$password = addslashes( $_POST['password'] );
$password = hash_hmac( "SHA256", $password, $secretKey);
$nome = addslashes( $_POST['nome'] );
$cognome = addslashes( $_POST['cognome'] );

$conn = new mysqli($host, $root, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Errore di connesione al server. ".$conn->connect_error);
}

$query = "select * from auth5ai where email='$email'";
$result = $conn->query($query);
if ($result->num_rows == 0) {
    $query = "insert into auth5ai (email, password, nome, cognome) values ('$email', '$password', '$nome', '$cognome')";
    $result = $conn->query($query);
    if($result){
        print("Registrazione effettuata con successo!");
    }
    else {
        die("Si è verificato un errore. Aggiorna la pagina e riprova.<br>" . $conn->error);
    }
} else {
    die("Utente già registrato con la email inserita!");
}

function exitFun(int $value, string $message) {
    $return_value = ['value' => $value, 'message' => $message];
    return json_encode($return_value);
}
?>