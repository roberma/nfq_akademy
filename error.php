<?php
$header = 'Prisijungti nepavyko';
if($_GET['id'] == '2') {
    $message = "Neteisingas prisijungimo vardas ir/arba slaptažodis. </br><a href='/login.php'>Bandykite dar kartą</a>";
}else {
    $message = "Įvyko klaida ir prisijungti nepavyko. <a href='/login.php'>Bandykite dar kartą</a> arba kreipkitės telefonu 1502";
}
?>
    <!DOCTYPE html>
    <html lang='lt'>
    <head>
        <meta charset='UTF-8'/>
        <title>Prisijungimas</title>
        <link rel='stylesheet' href='styles.css'/>
    </head>
    <body>
    <header class='register-header'>
        <h1><?php echo $header; ?></h1>
        <p><em><?php echo $message; ?></em></p>
    </header>
    </body>
    </html>
