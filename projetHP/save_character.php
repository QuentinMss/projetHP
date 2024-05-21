<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non authentifié.']);
    exit();
}

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($username, $password);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$character_name = $_POST['character_name'];

$sql = "INSERT INTO user_characters (user_id, character_name) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $character_name);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la sauvegarde du personnage.']);
}

$stmt->close();
$conn->close();
?>
