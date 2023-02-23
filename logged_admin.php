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
    $conn = new mysqli($servername, $username, $password,$dbname);


        // $id = mysqli_query($conn, "SELECT id FROM user_ WHERE login_= '$login_session' AND password_='$password_session'");


        // if($previous_password===$password_session){ 
        //     $sql5="UPDATE `user_` SET `login_`='$login_change',`password_`='$hashed_password',`email`='$email_change' WHERE login_='$login_session' ";

        //     if ($conn->query($sql5) === TRUE) {
        //         header("Location: start.html");
        //     }
        //     else{
        //         echo('Nie wpisano');
        //     }
        // }
        // else{
        // echo('unlucky');
        // }
    $result = mysqli_query($conn, "SELECT * FROM orders ");
    // $result = mysqli_query($conn, "SELECT * FROM user_ WHERE id= '$id'");
    echo '<table><tr><th>Id_zamówienia</th><th>Id_użytkownika</th><th>Id_pizzy</th><th>Ilość</th><th>Cena</th></tr>';
    while($row = mysqli_fetch_array($result)) {
        echo "<tr><td>{$row['id']}</td><td>{$row['user_id']}</td><td>{$row['pizza_id']}</td><td>{$row['quantity']}</td><td>{$row['price']}</td><td>{$row['date_']}</td></tr>";
    }
    echo '</table>';

    

?>

</body>
</html>