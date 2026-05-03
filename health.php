<?php
require_once 'config.php';

try {
   
    $stmt = $pdo->query("
        SELECT 
            DATE_FORMAT(recorded_at, '%H:00') as hour,
            AVG(heart_rate) as avg_heart_rate,
            AVG(temperature) as avg_temperature
        FROM sante_data
        WHERE recorded_at >= NOW() - INTERVAL 24 HOUR
        GROUP BY hour
        ORDER BY recorded_at ASC
    ");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $result = [];
    foreach ($data as $row) {
        $result[] = [
            'time' => $row['hour'],
            'heart_rate' => round($row['avg_heart_rate']),
            'temperature' => round($row['avg_temperature'], 1)
        ];
    }
    
    echo json_encode(['success' => true, 'health_data' => $result]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
