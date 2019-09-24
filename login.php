<?php
require_once ("dbconfig.php");
// create connection
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
        <h1>Specialisto prisijungimas</h1>
        <p><em>Norėdami prisijungti įveskite prisijungimo duomenis</em></p>
    </header>
        <form action='/specialist.php' method='post' class='register'>
            <div class='form-row'>
                <label for='email'>Prisijungimo vardas</label>
                <input id='email' name='email' type='email' placeholder="vardas@example.com" required/>
            </div>
            <div class='form-row'>
                <label for='pass'>Slaptažodis</label>
                <input id='pass' name='pass' type='password' placeholder="slaptažodis" required/>
            </div>
            <div class='form-row'>
                <button>Prisijungti</button>
            </div>
        </form>
    </body>
</html>
<?php
// free memory
$result->free();
// close connection
$conn->close();
?>