<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$host = "localhost";
$db = "wqbwzein_066";
$user = "wqbwzein_066";
$password = "lared1";

$mysqli = mysqli_connect($host, $user, $password, $db);


if ($mysqli == false) {
    // print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    print("error");
} else {
    $inputValue = $_POST["value"]; //value
    $item = $_POST["item"]; //name or lastname
    $id = $_SESSION["id"]; //id

    $mysqli->query("UPDATE `users` SET `$item`='$inputValue' WHERE `id`= '$id'");

    $_SESSION[$item] = $inputValue;
}