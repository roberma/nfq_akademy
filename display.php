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
$query= "SELECT * FROM client join (specialisation) on client.sp_id = specialisation.sp_id order by c_id limit 10";
$result = $conn->query($query);
if($result->num_rows == 0) {
    die ("Nepavyko prisijungti prie serverio: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang='lt'>
<head>
    <meta charset='UTF-8'/>
    <meta http-equiv="refresh" content="5">
    <title>Švieslentė</title>
    <link rel='stylesheet' href='styles.css'/>
</head>
<body>
<header class='register-header'>
    <h1>Švieslentė</h1>
    <p><em>Švieslentėje matote greitai savo eilę sulauksiančius klientus.</em></p>
    </br>
</header>
<div class='register'>
    <table class="form-table" cellspacing='1'>
        <tr>
            <th width="30%">Eilės numeris</th>
            <th width="70%">Specialistas</th>
        </tr>
        <?php while($row = $result->fetch_assoc()){
            ?>
        <tr>
            <td><?php echo $row['number']; ?>
            </td>
            <td><?php echo $row['specialisation']; ?></td>
        </tr>
        <?php }
        ?>
    </table>
</div>
</body>
</html>
<?php
// free memory
$result->free();
// close connection
$conn->close();
?>
