<?php
require_once ("dbconfig.php");
// tikrinimui ar visos reikšmės perduotos
$klaida = false;
// numerio formavimui
$abecele = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'V', 'Z');
if(isset($_GET['name']) && $_GET['name'] != '') {
    $name = $_GET['name'];
}else {
    $klaida = true;
}
if(isset($_GET['surname']) && $_GET['surname'] != '') {
    $surname = $_GET['surname'];
}else {
    $klaida = true;
}
if(isset($_GET['doctor']) && $_GET['doctor'] != '') {
    $sp = $_GET['doctor'];
}else {
    $klaida = true;
}
// create connection
$conn = new mysqli($host, $username, $password, $db);
// check connection
if ($conn->connect_error) {
    $klaida = true;
}
// check if cahracter set is not utf8
if ($conn->character_set_name() != "utf8") {
    // change character set to utf8
    if (!$conn->set_charset("utf8")) {
        $klaida = true;
    }
}
if(!$klaida) {
    $query= "SELECT number FROM client WHERE sp_id ='$sp' ORDER BY number DESC LIMIT 1";
    if (!$result = $conn->query($query)) {
        $klaida = true;
    }
    if ($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_NUM);
        $nr = intval(substr($row[0], 1, 4));
    } else {
        $nr = 0;
    }
    $nr = $nr + 1;
    $char = $abecele[$sp - 1];
    $number = sprintf("%s%04d", $char, $nr);
    $timestamp = new DateTime('NOW', new DateTimeZone('Europe/Vilnius'));
    $date = $timestamp->format("Y-m-d");
    $time = $timestamp->format("H:i:s");
    $query = "INSERT INTO client VALUES (null, '$name', '$surname', '$sp', '$number', '$date', '$time')";
}
if(!$klaida) {
    if (!$conn->query($query)) {
        $klaida = true;
    }
}
if (!$klaida) {
    $header = 'Užregistruota sėkmingai';
    $message = "Jūsų eilės numeris yra $number.";
}else {
    $header = 'Registracija nepavyko';
    $message = "Įvyko klaida ir užregistruoti nepavyko. <a href='/admin.php'>Bandykite dar kartą</a> arba kreipkitės telefonu 1502";
}
?>
<!DOCTYPE html>
<html lang='lt'>
<head>
    <meta charset='UTF-8'/>
    <title>Registracija</title>
    <link rel='stylesheet' href='styles.css'/>
</head>
<body>
<header class='register-header'>
    <h1><?php echo $header; ?></h1>
    <p><em><?php echo $message; ?></em></p>
</header>
</body>
</html>
<?php
// free memory
$result->free();
// close connection
$conn->close();
?>
