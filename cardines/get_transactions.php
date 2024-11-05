<?php
require_once 'config/database.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT * FROM transactions ORDER BY transaction_date DESC";
    $stmt = $pdo->query($sql);
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'data' => $transactions
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?> 