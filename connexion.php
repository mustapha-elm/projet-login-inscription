<?php
//code de connexion a la bd1 hostinger
try {
    $pdo = new PDO("mysql:host=****;port=3306;dbname=****;", "****", "****");
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}

