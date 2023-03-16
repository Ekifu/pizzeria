<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizzeria";

    $login_d = $_POST['login_d'];
    $password_d = $_POST['password_d'];

    function ceasarCipher($str) {
        $result = '';
        $str = strtolower($str); // zamieniamy na małe litery, aby ignorować wielkość liter
        $len = strlen($str);
        $shift = 3; // ustalamy przesunięcie na wartość 3
        // iterujemy po każdym znaku i przesuwamy go o wartość shift
        for($i = 0; $i < $len; $i++) {
            if(ord($str[$i]) >= 97 && ord($str[$i]) <= 122) { // tylko przesuwamy litery, ignorujemy znaki specjalne
                $result .= chr((ord($str[$i]) - 97 + $shift) % 26 + 97);
            } else {
                $result .= $str[$i];
            }
        }
        return $result;
    }

    $password_c=ceasarCipher($password_d);
    $hashed_password = sha1($password_c);
    $conn = new mysqli($servername, $username, $password, $dbname);

    $result = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `deliversman` WHERE `login_` = '$login_d' AND `password_` = '$hashed_password'"));
    if ($result != 1) {
        echo ('Niepoprawne hasło lub login'); 
    } else {
        header("Location: logged_deliversman.php");
    }
    ?>

</body>

</html>