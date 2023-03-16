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



    $result = mysqli_query($conn, "SELECT * FROM orders WHERE status_='1'");
    echo '<table><tr><th>Order ID</th><th>User ID</th><th>Pizza ID</th><th>Quantity</th><th>Price</th><th>Date</th><th>Status</th><th>Delivery</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>{$row['id']}</td><td>{$row['user_id']}</td><td>{$row['pizza_id']}</td><td>{$row['quantity']}</td><td>{$row['price']}</td><td>{$row['date_']}</td><td>{$row['status_']}</td><td>{$row['delivery']}</td></tr>";
    }
    echo '</table>';


    if (isset($_POST['CHANGE'])) {
        $order_id = $_POST['order_id'];




        $sql = "UPDATE `orders` SET `delivery`='1' WHERE id='$order_id' ";

        if ($conn->query($sql) === TRUE) {
            echo ('Changed');
        } else {
            echo ('Something went wrong');
        }
    }



    ?>
    <br><br>
    <form action="logged_deliversman.php" method="post">
        Order ID <input type="number" name="order_id" /><br /><br />
        <input type="submit" value="CHANGE" name="CHANGE" />
    </form>
    <br><br>
    <form action="start.html" method="get">
        <button type="submit">LOG OUT</button>
    </form>

</body>

</html>