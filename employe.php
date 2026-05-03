<?php
require_once 'config.php';

try {
    $stmt = $pdo->query("
        SELECT e.id, e.nom, e.prenom, e.email, e.department,
               (SELECT COUNT(*) FROM pointages WHERE employe_id = e.id AND date = CURDATE()) as present_today,
               (SELECT heart_rate FROM sante_data WHERE employe_id = e.id ORDER BY recorded_at DESC LIMIT 1) as last_heart_rate,
               (SELECT temperature FROM sante_data WHERE employe_id = e.id ORDER BY recorded_at DESC LIMIT 1) as last_temperature
        FROM employes e
        ORDER BY e.nom
    ");
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $result = [];
    foreach ($employees as $emp) {
        $result[] = [
            'name' => $emp['prenom'] . ' ' . $emp['nom'],
            'department' => $emp['department'],
            'email' => $emp['email'],
            'present_today' => (bool)$emp['present_today'],
            'last_heart_rate' => $emp['last_heart_rate'],
            'last_temperature' => $emp['last_temperature']
        ];
    }
    
    echo json_encode(['success' => true, 'employees' => $result]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
