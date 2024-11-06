<?php
include 'config.php'; // Include your database connection file

// Fetch transactions for Left Join
function fetchLeftJoinTransactions() {
    global $pdo;
    $stmt = $pdo->query("SELECT t.id, u.username, p.name AS product_name, t.quantity, t.total_amount, t.payment, t.created_at 
                          FROM transactions t 
                          LEFT JOIN users u ON t.user_id = u.id 
                          LEFT JOIN products p ON t.product_id = p.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch transactions for Right Join
function fetchRightJoinTransactions() {
    global $pdo;
    $stmt = $pdo->query("SELECT t.id, u.username, p.name AS product_name, t.quantity, t.total_amount, t.payment, t.created_at 
                          FROM transactions t 
                          RIGHT JOIN users u ON t.user_id = u.id 
                          RIGHT JOIN products p ON t.product_id = p.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch transactions for Union Join
function fetchUnionTransactions() {
    global $pdo;
    $stmt = $pdo->query("SELECT t.id AS transaction_id, u.username, t.total_amount 
                          FROM transactions t 
                          JOIN users u ON t.user_id = u.id 
                          UNION 
                          SELECT NULL, u.username, NULL 
                          FROM users u");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$leftJoinTransactions = fetchLeftJoinTransactions();
$rightJoinTransactions = fetchRightJoinTransactions();
$unionTransactions = fetchUnionTransactions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1600') center/cover fixed;
            color: #2C3E50;
            min-height: 100vh;
        }

        /* Navbar styles */
        .navbar {
            background: linear-gradient(to right, #8B4513, #D2691E);
            padding: 1em 2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 15px rgba(0,0,0,0.2);
        }

        .navbar .logo {
            font-weight: 700;
            color: #FFF8DC;
            font-size: 24px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .navbar a {
            color: #FFF8DC;
            margin-left: 2em;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .navbar a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        /* Container styles */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        h1 {
            color: #8B4513;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        /* Button container styles */
        .button-container {
            text-align: center;
            margin-bottom: 30px;
        }

        button {
            background: linear-gradient(to right, #8B4513, #D2691E);
            color: #FFF8DC;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            margin: 0 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.2);
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(139, 69, 19, 0.3);
        }

        /* Table container styles */
        .table-container {
            background: rgba(255, 248, 220, 0.95);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }

        .table-container h2 {
            color: #8B4513;
            font-size: 1.8em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #D2691E;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-top: 20px;
        }

        th {
            background: linear-gradient(to right, #8B4513, #D2691E);
            color: #FFF8DC;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }

        th:first-child {
            border-radius: 10px 0 0 10px;
        }

        th:last-child {
            border-radius: 0 10px 10px 0;
        }

        td {
            background: white;
            padding: 15px;
            color: #2C3E50;
            border-top: 1px solid #DEB887;
            border-bottom: 1px solid #DEB887;
        }

        td:first-child {
            border-left: 1px solid #DEB887;
            border-radius: 10px 0 0 10px;
        }

        td:last-child {
            border-right: 1px solid #DEB887;
            border-radius: 0 10px 10px 0;
        }

        tr {
            transition: all 0.3s;
        }

        tr:hover td {
            background: #FFF8DC;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
        }

        /* Hidden class */
        .hidden {
            display: none;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1em;
                flex-direction: column;
                text-align: center;
            }

            .navbar a {
                margin: 10px;
            }

            .button-container {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            button {
                width: 100%;
                margin: 5px 0;
            }

            .container {
                padding: 10px;
            }

            .table-container {
                padding: 15px;
                overflow-x: auto;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <div class="logo">RESTAURANT</div>
    <div>
        <a href="history.php">History Log</a>
        <a href="dashboard.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h1>Transaction History</h1>
    <div class="button-container">
        <button onclick="showTable('leftJoin')">Left Join</button>
        <button onclick="showTable('rightJoin')">Right Join</button>
        <button onclick="showTable('unionJoin')">Union Join</button>
    </div>

    <!-- Table for Left Join -->
    <div id="leftJoin" class="table-container">
        <h2>Left Join Transactions</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Payment</th>
                <th>Date</th>
            </tr>
            <?php foreach ($leftJoinTransactions as $transaction): ?>
                <tr>
                    <td><?php echo $transaction['id']; ?></td>
                    <td><?php echo $transaction['username'] ?? 'N/A'; ?></td>
                    <td><?php echo $transaction['product_name'] ?? 'N/A'; ?></td>
                    <td><?php echo $transaction['quantity']; ?></td>
                    <td><?php echo $transaction['total_amount']; ?></td>
                    <td><?php echo $transaction['payment']; ?></td>
                    <td><?php echo $transaction['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Table for Right Join -->
    <div id="rightJoin" class="table-container hidden">
        <h2>Right Join Transactions</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Payment</th>
                <th>Date</th>
            </tr>
            <?php foreach ($rightJoinTransactions as $transaction): ?>
                <tr>
                    <td><?php echo $transaction['id']; ?></td>
                    <td><?php echo $transaction['username'] ?? 'N/A'; ?></td>
                    <td><?php echo $transaction['product_name'] ?? 'N/A'; ?></td>
                    <td><?php echo $transaction['quantity']; ?></td>
                    <td><?php echo $transaction['total_amount']; ?></td>
                    <td><?php echo $transaction['payment']; ?></td>
                    <td><?php echo $transaction['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Table for Union Join -->
    <div id="unionJoin" class="table-container hidden">
        <h2>Union Join Transactions</h2>
        <table>
            <tr>
                <th>Transaction ID</th>
                <th>Username</th>
                <th>Total Amount</th>
            </tr>
            <?php foreach ($unionTransactions as $transaction): ?>
                <tr>
                    <td><?php echo $transaction['transaction_id'] ?? 'N/A'; ?></td>
                    <td><?php echo $transaction['username']; ?></td>
                    <td><?php echo $transaction['total_amount'] ?? 'N/A'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<script>
    function showTable(tableName) {
        // Hide all table containers
        const tables = document.querySelectorAll('.table-container');
        tables.forEach(table => table.classList.add('hidden'));

        // Show the selected table
        document.getElementById(tableName).classList.remove('hidden');
    }

    showTable('leftjoin');
</script>

</body>
</html> 
