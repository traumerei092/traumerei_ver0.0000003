<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $movie = $_POST['movie'];
    $sports = $_POST['sports'];
    $hobby = $_POST['hobby'];
    $shop = $_POST['shop'];

    // デバッグログ
    error_log("Received data: name=$name, age=$age, movie=$movie, sports=$sports, hobby=$hobby, shop=$shop");

    $file_path = 'data/' . $shop . '.csv';

    if (!file_exists('data')) {
        mkdir('data', 0777, true);
    }

    $file = fopen($file_path, 'a');
    if ($file === false) {
        die("Error: Unable to open file ($file_path)");
    }

    $result = fputcsv($file, [$name, $age, $movie, $sports, $hobby]);
    if ($result === false) {
        die("Error: Unable to write to file ($file_path)");
    }

    fclose($file);
    header('Location: index.php');
    exit();
}
?>
