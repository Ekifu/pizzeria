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
    $conn = new mysqli($servername, $username, $password, $dbname);

    $login_session = $_SESSION["login"];
    $hashed_password_session = $_SESSION["hashed_password"];
    $password_session = $_SESSION["password"];
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

    if (isset($_POST['CHANGE'])) {
        $previous_password = $_POST['previous_password'];
        $login_change = $_POST['login_change'];
        $password_change = $_POST['password_change'];
        $email_change = $_POST['email_change'];
        $password_c = ceasarCipher($password_change);
        $hashed_password=sha1($password_c);

        $c_previous=ceasarCipher($previous_password);




        if (sha1($c_previous) === sha1($password_session)) {
            $sql5 = "UPDATE `user_` SET `login_`='$login_change',`password_`='$hashed_password',`email`='$email_change' WHERE login_='$login_session' ";

            if ($conn->query($sql5) === TRUE) {
                header("Location: start.html");
            } else {
                echo ('Nie wpisano');
            }
        } else {
            echo ('unlucky');
        }

    }


    $hashed_password2 = sha1($password_session);

    $result = mysqli_query($conn, "SELECT * FROM user_ WHERE login_= '$login_session' AND password_='$hashed_password2'");
    // $result = mysqli_query($conn, "SELECT * FROM user_ WHERE id= '$id'");
    echo '<table><tr><th>Login</th><th>Email</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>{$row['login_']}</td><td>{$row['email']}</td></tr>";
    }
    echo '</table>';


    ?>
    <!-- 
    <br><br><br>
    <div>MENU</div><br>
    <div>What dou you want to order?</div><br>
    <form action="logged.php" method="post">
        Capriciosa: <input type="radio" value="capriciosa" name="pizza"><br><br>
        Margheritta: <input type="radio" value="margheritta"name="pizza"><br><br>
        Pepperoni: <input type="radio" value="pepperoni"name="pizza"><br><br>
        Hawaiian: <input type="radio" value="hawaiian"name="pizza"><br><br>
        <input type="submit" value="ORDER">
    </form> -->
    <br><br><br>
    <form action="koszyk.php" method="get">
        <button type="submit">ORDER</button>
    </form>

    <br><br><br><br>

    <div>CHANGE DATA</div><br>
    <form action="logged.php" method="post">
        New login: <input type="text" name="login_change"><br><br>
        New password: <input type="password" name="password_change"><br><br>
        New e-mail: <input type="text" name="email_change"><br><br>
        Previous password: <input type="password" name="previous_password"><br><br>
        <input type="submit" value="CHANGE" name="CHANGE">
    </form>
    <br><br>
    <form action="start.html" method="get">
        <button type="submit">LOG OUT</button>
    </form>

</body>

</html>