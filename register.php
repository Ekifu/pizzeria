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

    $login_r = $_POST['login_r'];
    $password_r = $_POST['password_r'];
    $email_r = $_POST['email_r'];


    $hashed_password = sha1($password_r);

    $conn = new mysqli($servername, $username, $password, $dbname);


    if (!filter_var($email_r, FILTER_VALIDATE_EMAIL)) {
        $email_r = "Invalid email format";
        echo ('Niepoprawny e-mail');

    } else {
        $sql = "INSERT INTO user_ (login_ ,password_,email) VALUES ('$login_r', '$hashed_password', '$email_r')";
        if ($conn->query($sql) === TRUE) {
            header("Location: start.html");
        } else {
            echo ('Error: " . $sql . "<br>" . $conn->error');
        }
    }
    ?>



</body>

</html>