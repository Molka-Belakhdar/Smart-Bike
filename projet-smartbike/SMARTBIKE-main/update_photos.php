<?php
require_once 'config.php';

try {
    $pdo->exec("UPDATE velos SET photo = 'bike_one.jpg' WHERE nom = 'BikeOne'");
    $pdo->exec("UPDATE velos SET photo = 'bike22.jpg' WHERE nom = 'Bike22'");
    $pdo->exec("UPDATE velos SET photo = 'bikefirst.png' WHERE nom = 'BikeFirst'");
    $pdo->exec("UPDATE velos SET photo = 'bike5.png' WHERE nom = 'Bike5'");
    echo 'Photos updated successfully.';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>