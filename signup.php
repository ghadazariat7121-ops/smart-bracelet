<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$nomComplet = explode(' ', $data['fullname'] ?? '', 2);
$prenom = $nomComplet[0];
$nom = $nomComplet[1] ?? '';
$email = $data['email'] ?? '';
$role = $data['role'] ?? 'employe';
$password = $data['password'] ?? '';

if (empty($prenom) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Champs manquants']);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO employes (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $hashedPassword, $role]);
    echo json_encode(['success' => true, 'message' => 'Compte créé']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Email déjà utilisé']);
}
?>
