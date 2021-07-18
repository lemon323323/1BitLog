<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1BitLog | Sign up</title>
</head>
<body>
    <form action="login.php" method="POST">
        <p id="f">Введите логин и пароль</p>
        <input type="text" name="name" placeholder="Логин" id="log">
        <input type="password" name="pass" placeholder="Пароль" id="pas">
        <input type="submit" value="Войти" id="sub">
</body>
</html>
<?php
require 'config\dbconfig.php';
$conn = new mysqli($h, $n, $p, $db);
if (isset($_POST['name']) && isset($_POST['pass'])){
    $name = anti_hack($conn, 'name');
    $pass = anti_hack($conn, 'pass');
    $query = "SELECT users,password FROM users WHERE users='$name' AND password='$pass'";
    $result = $conn->query($query);
    if ($result->num_rows == 0){
        echo "Неверный пароль или логин";
    }
    else{
        echo "Вы вошли в свой аккаунт";
    }
}
function anti_hack($conn, $target){
    return $conn->real_escape_string($_POST[$target]);
}
?>