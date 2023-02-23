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

// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzeria";


$conn = mysqli_connect($servername, $username, $password, $dbname);

// Inicjalizacja koszyka
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}
$login_session = $_SESSION["login"];
$hashed_password_session = $_SESSION["hashed_password"];
$query = "SELECT id FROM user_ WHERE login_='$login_session' AND password_='$hashed_password_session'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$userId = $row['id'];

$pizzas = array(
    1 => array('name' => 'Margherita', 'price' => 15),
    2 => array('name' => 'Funghi', 'price' => 18),
    3 => array('name' => 'Capricciosa', 'price' => 20),
    4 => array('name' => 'Quattro Stagioni', 'price' => 22)
  );
  
  // Dodawanie pizzy do koszyka
  if (isset($_GET['add'])) {
    $pizzaId = $_GET['add'];
    if (!isset($_SESSION['cart'][$pizzaId])) {
      $_SESSION['cart'][$pizzaId] = 1;
    } else {
      $_SESSION['cart'][$pizzaId]++;
    }
  }
  
  // Usuwanie pizzy z koszyka
  if (isset($_GET['delete'])) {
    $pizzaId = $_GET['delete'];
    unset($_SESSION['cart'][$pizzaId]);
  }
  
  // Dodawanie zamówienia do historii zakupów
  if (isset($_GET['checkout'])) {
    $user_id = 1; // Tymczasowe ustawienie id użytkownika
    $date = date('Y-m-d H:i:s');
    $total = 0;
    foreach ($_SESSION['cart'] as $pizzaId => $quantity) {
      $pizza = $pizzas[$pizzaId];
      $price = $pizza['price'] * $quantity;
      $total += $price;
      $query = "INSERT INTO orders (user_id, pizza_id, quantity, price, date_) VALUES ('$userId', '$pizzaId', '$quantity', '$price', '$date')";
      // $query = "INSERT INTO orders (user_id, pizza_id, quantity, price, date_) VALUE mysqli_query('$conn', '$query')";
      $result = mysqli_query($conn, $query);
    }
    $_SESSION['cart'] = array();
  }
  

// Wypisanie formularza dodawania pizzy
echo '<h2>Dodaj pizzę do koszyka</h2>';
echo '<form>';
echo '<select name="add">';
foreach ($pizzas as $id => $pizza) {
  echo "<option value   = $id>{$pizza['name']} ({$pizza['price']} zł)</option>";
}
echo '</select>';
echo '<input type="submit" value="Dodaj">';
echo '</form>';

// Wypisanie zawartości koszyka
echo '<h2>Zawartość koszyka</h2>';
if (!empty($_SESSION['cart'])) {
  echo '<table>';
  echo '<tr><th>Nazwa</th><th>Ilość</th><th>Cena</th><th></th></tr>';
  $total = 0;
  foreach ($_SESSION['cart'] as $pizzaId => $quantity) {
    $pizza = $pizzas[$pizzaId];
    $price = $pizza['price'] * $quantity;
    $total += $price;
    echo "<tr>";
    echo "<td>{$pizza['name']}</td>";
    echo "<td>$quantity</td>";
    echo "<td>$price zł</td>";
    echo "<td><a href='?delete=$pizzaId'>Usuń</a></td>";
    echo "</tr>";
  }
  echo "<tr><td colspan='2'>Łącznie:</td><td colspan='2'>$total zł</td></tr>";
  echo '</table>';
  echo "<p><a href='?checkout'class='checkout-button'>Zamów</a></p>";
} else {
  echo '<p>Koszyk jest pusty</p>';
}
// Wyświetlanie historii zakupów
echo '<h2>Historia zakupów</h2>'; // Tymczasowe ustawienie id użytkownika
$query = "SELECT * FROM orders WHERE user_id = $userId ORDER BY date_ DESC";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  echo '<table>';
  echo '<tr><th>Data</th><th>Nazwa</th><th>Ilość</th><th>Cena</th></tr>';
  while ($row = mysqli_fetch_assoc($result)) {
    $pizzaId = $row['pizza_id'];
    $pizza = $pizzas[$pizzaId];
    echo '<tr>';
    echo "<td>{$row['date_']}</td>";
    echo "<td>{$pizza['name']}</td>";
    echo "<td>{$row['quantity']}</td>";
    echo "<td>{$row['price']}</td>";
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo 'Brak zamówień.';
}
$query = "SELECT SUM(price) AS total FROM orders WHERE user_id = $userId";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total = $row['total'];
echo "<h2>Suma zamówień w historii: $total zł</h2>";
?>
    
</body>
</html>