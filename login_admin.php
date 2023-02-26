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

    $login_a = $_POST['login_a'];
    $password_a = $_POST['password_a'];

    $hashed_password = sha1($password_a);
    $conn = new mysqli($servername, $username, $password, $dbname);

    $result = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `admin` WHERE `login_` = '$login_a' AND `password_` = '$hashed_password'"));
    if ($result != 1) {
        echo ('Niepoprawne hasło lub login');
    } else {
        header("Location: logged_admin.php");
    }
    ?>

</body>

</html>