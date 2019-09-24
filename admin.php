<?php
require_once ("dbconfig.php");
// create connection
$conn = new mysqli($host, $username, $password, $db);

// check connection
if ($conn->connect_error) {
    die("Nepavyko prisijungti prie serverio: " . $conn->connect_error);
}
// check if cahracter set is not utf8
if ($conn->character_set_name() != "utf8") {
    // change character set to utf8
    if (!$conn->set_charset("utf8")) {
        die ("Nepavyko pasirinkti lietuviškų simbolių: " . $conn->error);
    }
}
$query= "SELECT * FROM specialisation";
$result = $conn->query($query);
if($result->num_rows == 0) {
    die ("Nepavyko prisijungti prie serverio: " . $conn->error);
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
        <h1>Registacija vizitui pas gydytoją</h1>
        <p><em>Norėdami užsiregistruoti pas gydytoją užpildykite šią formą ir gaukite eilės numerį</em></p>
    </header>
    <form action='/register.php' method='get' class='register'>
        <div class='form-row'>
            <label for='name'>Vardas</label>
            <input id='name' name='name' type='text' required/>
        </div>
        <div class='form-row'>
            <label for='surname'>Pavardė</label>
            <input id='surname' name='surname' type='text' required/>
        </div>
        <div class='form-row'>
            <label for='doctor'>Gydytojas</label>
            <select id='doctor' name='doctor'>
                <?php while($row = $result->fetch_array(MYSQLI_NUM)) {?>
                <option value='<?php echo $row[0]?>'><?php echo $row[1]?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class='form-row'>
            <button>Užsiregistruoti</button>
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