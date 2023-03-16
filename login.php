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

    $login_l = $_POST['login_l'];
    $password_l = $_POST['password_l'];
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

    $password_c=ceasarCipher($password_l);

    $hashed_password = sha1($password_c);

    $_SESSION["login"] = $login_l;
    $_SESSION["hashed_password"] = $hashed_password;
    $_SESSION["password"] = $password_c;

    $conn = new mysqli($servername, $username, $password, $dbname);

    $result = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `user_` WHERE `login_` = '$login_l' AND `password_` = '$hashed_password'"));
    if ($result != 1) {
        echo ('Wrong login or password');
    } else {
        header("Location: logged.php");
    }

    ?>

</body>

</html>