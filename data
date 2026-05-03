<?php
require_once 'config.php';

try {
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM employes");
    $totalEmployees = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
   
    $stmt = $pdo->prepare("SELECT COUNT(DISTINCT employe_id) as present FROM pointages WHERE date = CURDATE()");
    $stmt->execute();
    $presentToday = $stmt->fetch(PDO::FETCH_ASSOC)['present'];
    

    $stmt = $pdo->query("SELECT COUNT(*) as alerts FROM alertes WHERE resolu = FALSE");
    $activeAlerts = $stmt->fetch(PDO::FETCH_ASSOC)['alerts'];
    
   
    $stmt = $pdo->query("SELECT AVG(heart_rate) as avgBpm FROM sante_data WHERE recorded_at >= NOW() - INTERVAL 1 DAY AND heart_rate > 0");
    $avgHeartRate = round($stmt->fetch(PDO::FETCH_ASSOC)['avgBpm'] ?? 72);
    
    echo json_encode([
        'success' => true,
        'total_employees' => (int)$totalEmployees,
        'present_today' => (int)$presentToday,
        'active_alerts' => (int)$activeAlerts,
        'avg_heart_rate' => $avgHeartRate
    ]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
