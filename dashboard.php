<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1600') center/cover fixed;
            color: #2C3E50;
            min-height: 100vh;
        }

        /* Navbar styles */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 1em 2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar .logo {
            font-weight: 700;
            color: #E67E22;
            font-size: 24px;
        }

        .navbar .logo i {
            margin-right: 10px;
        }

        .navbar a {
            color: #2C3E50;
            margin-left: 2em;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .navbar a:hover {
            color: #E67E22;
            transform: translateY(-2px);
        }

        /* Dashboard content styles */
        .dashboard {
            padding: 2em;
            max-width: 800px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }

        .dashboard h1 {
            color: #E67E22;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #E67E22;
        }

        .product-selection, .checkout {
            margin-top: 20px;
            background-color: #FFF;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            border: 1px solid #ECF0F1;
        }

        .product-selection label, .checkout label {
            color: #2C3E50;
            font-weight: 600;
            display: block;
            margin-bottom: 10px;
        }

        .product-selection select, .product-selection input, .checkout input {
            padding: 12px;
            margin-bottom: 20px;
            width: 100%;
            background-color: #F8F9FA;
            color: #2C3E50;
            border: 2px solid #ECF0F1;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .product-selection select:focus, 
        .product-selection input:focus, 
        .checkout input:focus {
            border-color: #E67E22;
            outline: none;
            box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
        }

        /* Checkout button styles */
        .checkout button {
            background-color: #E67E22;
            color: white;
            padding: 15px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .checkout button:hover {
            background-color: #D35400;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.3);
        }

        /* Message styles */
        .warning {
            font-weight: 500;
            margin-top: 15px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
        }

        .warning.success {
            background-color: #E8F8F5;
            color: #27AE60;
            border: 1px solid #27AE60;
        }

        .warning.error {
            background-color: #FDEDEC;
            color: #E74C3C;
            border: 1px solid #E74C3C;
        }

        /* Menu Card Style */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .menu-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid #ECF0F1;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .menu-item img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .menu-item h3 {
            color: #2C3E50;
            margin: 10px 0;
        }

        .menu-item .price {
            color: #E67E22;
            font-weight: 600;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .dashboard {
                margin: 10px;
                padding: 15px;
            }
            
            .navbar {
                padding: 1em;
                flex-direction: column;
                text-align: center;
            }
            
            .navbar a {
                margin: 10px;
            }
            
            .menu-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <div class="logo">
        <i class="fas fa-utensils"></i> Restaurant POS
    </div>
    <div>
        <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
        <a href="history.php"><i class="fas fa-history"></i> History</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- Dashboard Section -->
<div class="dashboard">
    <h1><i class="fas fa-cash-register"></i> Point of Sale System</h1>

    <!-- Product Selection -->
    <div class="product-selection">
        <label for="product"><i class="fas fa-hamburger"></i> Select Menu Item:</label>
        <select id="product">
            <option value="1" data-price="12">Pizza- $12</option>
            <option value="2" data-price="10">Burger- $10</option>
            <option value="3" data-price="15">Pasta- $15</option>
            <option value="4" data-price="10">Salad- $10</option>
            <option value="5" data-price="15">Sushi- $15</option>
            <option value="6" data-price="10">Sandwich- $10</option>
            <option value="7" data-price="4">Soup- $4</option>
            <option value="8" data-price="5">Ice Cream- $5</option>
            <option value="9" data-price="7">Fries- $7</option>
        </select>

        <label for="quantity"><i class="fas fa-sort-numeric-up"></i> Quantity:</label>
        <input type="number" id="quantity" min="1" placeholder="Enter quantity">
    </div>

    <!-- Checkout Section -->
    <div class="checkout">
        <label for="payment"><i class="fas fa-money-bill-wave"></i> Payment Amount:</label>
        <input type="number" id="payment" placeholder="Enter payment amount">

        <button onclick="processTransaction()">
            <i class="fas fa-shopping-cart"></i> Process Order
        </button>

        <div id="message" class="warning"></div>
    </div>
</div>

<script>
    // JavaScript to handle POS logic
    function processTransaction() {
        const product = document.getElementById("product");
        const productId = product.value;
        const quantity = parseInt(document.getElementById("quantity").value);
        const payment = parseFloat(document.getElementById("payment").value);
        const message = document.getElementById("message");

        // Validate inputs
        if (isNaN(quantity) || isNaN(payment) || quantity <= 0 || payment <= 0) {
            message.style.color = 'red';
            message.innerText = 'Please enter valid quantity and payment amount.';
            return;
        }

        // Send transaction data to server
        fetch('process_transaction.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `product_id=${productId}&quantity=${quantity}&payment=${payment}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                message.style.color = 'green';
                message.innerText = `Transaction successful! Change: $${data.change.toFixed(2)}`;
            } else {
                message.style.color = 'red';
                message.innerText = data.message;
            }
        })
        .catch(error => {
            message.style.color = 'red';
            message.innerText = 'Error processing transaction. Please try again.';
        });
    }
</script>

</body>
</html>
