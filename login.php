<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    $hashed_password = sha1($password_l);

    $_SESSION["login"] = $login_l;
    $_SESSION["hashed_password"] = $hashed_password;
    $_SESSION["password"] = $password_l;

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