<?php
require_once 'config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $product = $data['product'];
    $quantity = $data['quantity'];
    $total = $data['total'];
    $payment = $data['payment'];
    $change = $data['change'];

    try {
        $sql = "INSERT INTO transactions (product, quantity, total_amount, payment_amount, change_amount, transaction_date) 
                VALUES (:product, :quantity, :total, :payment, :change, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':product' => $product,
            ':quantity' => $quantity,
            ':total' => $total,
            ':payment' => $payment,
            ':change' => $change
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Transaction saved successfully'
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
}
?>
