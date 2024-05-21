<?php
session_start();

$servername = "";
$username = "";
$password = "";
$dbname = "";


$conn = new mysqli($username, $password);


if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}


$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 


$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param($username, $password);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'inscription.']);
}

$stmt->close();
$conn->close();
?>
