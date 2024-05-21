<?php
session_start();

$servername = "ma bdd";
$username = "le user name";
$password = "le password";
$dbname = "le nom de la bdd";

$conn = new mysqli($username, $password);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT id, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_id, $hashed_password);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $user_id;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Nom d\'utilisateur ou mot de passe incorrect.']);
}

$stmt->close();
$conn->close();
?>
