<?php
require_once ("dbconfig.php");
session_start();
if (isset($_POST['email'])){
    unset($_SESSION['login']);
}
// tikrinimui ar visos reikšmės perduotos
$klaida = 0;
echo $_SESSION['sp'];
echo "</br>";
// create connection
$conn = new mysqli($host, $username, $password, $db);
// check connection
if ($conn->connect_error) {
    $klaida = 1;
}
// check if cahracter set is not utf8
if ($conn->character_set_name() != "utf8") {
    // change character set to utf8
    if (!$conn->set_charset("utf8")) {
        $klaida = 1;
    }
}
if (!$_SESSION['login']) {
    if (isset($_POST['email']) && $_POST['email'] != '') {
        $user = $_POST['email'];
    } else {
        $klaida = 1;
    }
    if (isset($_POST['pass']) && $_POST['pass'] != '') {
        $pass = $_POST['pass'];
    } else {
        $klaida = 1;
    }
    if($klaida == 0) {
        $hash = '';
        $sp = '';
        $query = "SELECT * FROM specialist WHERE email ='$user'";
        if (!$result = $conn->query($query)) {
            $klaida = 1;
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hash = $row['pass'];
            $sp = $row['sp_id'];
        } else {
            $klaida = 2;
        }
        if (password_verify($pass, $hash)) {
            $_SESSION['login'] = true;
            $_SESSION['sp'] = $sp;
            $_SESSION['empty'] = false;
        } else {
            $klaida = 2;
        }
    }
    if ($klaida == 0) {
        $header = "Specialisto puslapis";
        $message = "Sveikiname sėkmingai prisijungus. Norėdami pakviesti pirmą pacientą paspauskite žemiau esantį mygtuką";
    } else {
        session_destroy();
        header("Location: /error.php?id=$klaida");
        exit;
    }
} else {
    if($_POST['submit'] == 'next' || $_SESSION['empty'])
    {
        $sp = $_SESSION['sp'];
        $query = "SELECT * FROM client WHERE sp_id=$sp limit 1";
        if (!$result = $conn->query($query)) {
            $klaida = 1;
        }
        $rows = $result->num_rows;
        if ($rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['c_id'];
            $name = $row['name'];
            $surname = $row['surname'];
            $number = $row['number'];
            $_SESSION['empty'] = false;
            $header = "Specialisto puslapis";
            $message = "Aptarnaujamas pacientas: <strong>$name $surname</strong>. </br> Eilės numeris: <strong>$number</strong>";
        } else {
            $_SESSION['empty'] = true;
            $header = "Specialisto puslapis";
            $message = "Šiuo metu daugiau pacientų nėra.";
        }
        if ($klaida == 0 && $rows > 0) {
            $query = "DELETE FROM client WHERE c_id=$id";
            if (!$conn->query($query)) {
                echo "trecia</br>";
                $klaida = 1;
            }
        }
    } else {
        $klaida = 1;
    }
    if ($klaida > 0) {
        session_destroy();
        header("Location: /error.php?id=$klaida");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang='lt' xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset='UTF-8'/>
        <?php if($_SESSION['empty']) { ?>
        <meta http-equiv="refresh" content="5">
        <?php } ?>
        <title>Registracija</title>
        <link rel='stylesheet' href='styles.css'/>
    </head>
    <body>
        <header class='register-header'>
            <h1><?php echo $header; ?></h1>
            <p><em><?php echo $message; ?></em></p></br>
            <p><em>Norėdami atsijungti spauskite <a href="logout.php">čia</a></em></p>
        </header>
        <form action='' method='post' class='register'>
            <div class='form-row'>
                <input id='submit' name='submit' value='next' type='hidden'/>
                <button>Kitas lankytojas</button>
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