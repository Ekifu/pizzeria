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
    echo '<table><tr><th>Order ID</th><th>User ID</th><th>Pizza ID</th><th>Quantity</th><th>Price</th><th>Date</th><th>Status</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>{$row['id']}</td><td>{$row['user_id']}</td><td>{$row['pizza_id']}</td><td>{$row['quantity']}</td><td>{$row['price']}</td><td>{$row['date_']}</td><td>{$row['status_']}</td></tr>";
    }
    echo '</table>';


    if (isset($_POST['CHANGE'])) {
        $order_id = $_POST['order_id'];






    }



    ?>
    <br><br>
    <form action="logged_admin.php" method="post">
        Order ID <input type="number" name="order_id" /><br /><br />
        <input type="submit" value="CHANGE" name="CHANGE" />
    </form>
    <br><br>
    <form action="start.html" method="get">
        <button type="submit">LOG OUT</button>
    </form>

</body>

</html>