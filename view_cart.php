<?php
session_start();

// Connect to database to process final order placement
$conn = new mysqli("localhost", "root", "", "bitebase");
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// 🗑️ Handle single item deletion from cart if requested
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['key'])) {
    $delete_key = intval($_GET['key']);
    if (isset($_SESSION['cart'][$delete_key])) {
        unset($_SESSION['cart'][$delete_key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index arrays cleanly
    }
    header("Location: view_cart.php");
    exit();
}

// 📦 Handle final checkout and order insertion into database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finalize_order'])) {
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    
    if (!empty($_SESSION['cart']) && !empty($customer_name)) {
        $items_array = [];
        $total_amount = 0;
        
        foreach ($_SESSION['cart'] as $item) {
            // Safe fallback check for item names during checkout loop
            $name = isset($item['name']) ? $item['name'] : (isset($item['item_name']) ? $item['item_name'] : 'Unknown Dish');
            $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
            $price = isset($item['price']) ? $item['price'] : 0;
            
            $items_array[] = $name . " (x" . $quantity . ")";
            $total_amount += ($price * $quantity);
        }
        
        $items_ordered_string = $conn->real_escape_string(implode(", ", $items_array));
        
        // Insert into your plural 'orders' table matching phpMyAdmin exactly
        $insert_query = "INSERT INTO `orders` (customer_name, items_ordered, total_amount, status) 
                         VALUES ('$customer_name', '$items_ordered_string', $total_amount, 'Pending')";
        
        if ($conn->query($insert_query)) {
            $_SESSION['cart'] = []; // Wipe cart clean after successful purchase
            echo "<script>alert('Order successfully finalized and sent to admin dashboard!'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Database Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please provide a name and ensure your cart isn\'t empty!');</script>";
    }
}

// Calculate grand total for view presentation
$grand_total = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
        $price = isset($item['price']) ? $item['price'] : 0;
        $grand_total += ($price * $quantity);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | BiteBase</title>
</head>
<body style="background-color: #f4f4f4; margin: 0; padding: 40px 0; font-family: Arial, sans-serif;">

    <div style="max-width: 800px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">

        <!-- HEADER BANNER -->
        <div style="background: #000; color: #fff; padding: 20px; text-align: center; margin-bottom: 35px; border: 4px solid #000;">
            <h1 style="margin: 0; font-size: 32px; font-weight: 900; font-family: sans-serif; letter-spacing: 1px; text-transform: uppercase;">
                YOUR CART
            </h1>
        </div>

        <a href="index.php" style="color: #000; text-decoration: none; font-weight: bold; font-family: monospace; font-size: 14px; display: inline-block; margin-bottom: 20px; text-transform: uppercase;">
            ← Continue Shopping
        </a>

        <!-- CART INTERFACE CARD -->
        <div style="background: #fff; border: 4px solid #000; padding: 40px; box-shadow: 10px 10px 0px #000;">
            
            <?php if (!empty($_SESSION['cart'])): ?>
                
                <?php foreach ($_SESSION['cart'] as $key => $item): 
                    // 🔍 CRITICAL FIX: Fallback lookup check for 'name' vs 'item_name' keys on Line 42 area
                    $dish_display_name = '';
                    if (isset($item['name'])) {
                        $dish_display_name = $item['name'];
                    } elseif (isset($item['item_name'])) {
                        $dish_display_name = $item['item_name'];
                    } else {
                        $dish_display_name = 'Unknown Dish';
                    }
                    
                    $qty = isset($item['quantity']) ? $item['quantity'] : 1;
                    $price = isset($item['price']) ? $item['price'] : 0;
                    $item_total = $price * $qty;
                ?>
                    <!-- Individual Cart Row Component -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 2px dashed #000;">
                        <div>
                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: bold; text-transform: uppercase; font-family: sans-serif;">
                                <?php echo htmlspecialchars($dish_display_name); ?> <span style="font-family: monospace; color: #666;">(x<?php echo $qty; ?>)</span>
                            </h3>
                            <span style="font-family: monospace; font-size: 14px; color: #666;">
                                Rs. <?php echo number_format($price); ?> each
                            </span>
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <span style="font-size: 16px; font-weight: bold; font-family: monospace; color: #000;">
                                Rs. <?php echo number_format($item_total); ?>
                            </span>
                            <!-- Row Clear Button -->
                            <a href="view_cart.php?action=delete&key=<?php echo $key; ?>" 
                               style="background: #000; color: #fff; text-decoration: none; padding: 6px 12px; font-size: 11px; font-weight: bold; font-family: monospace; border: 2px solid #000; text-transform: uppercase;">
                                Delete
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Grand Total Display Unit -->
                <div style="margin-top: 30px; padding-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                    <h2 style="margin: 0; font-family: sans-serif; font-weight: 900; text-transform: uppercase; font-size: 24px;">
                        Total Amount:
                    </h2>
                    <span style="font-size: 26px; font-weight: 900; font-family: monospace; color: #10b981;">
                        Rs. <?php echo number_format($grand_total); ?>
                    </span>
                </div>

                <!-- Checkout Process Target Action form -->
                <form action="view_cart.php" method="POST" style="margin-top: 40px; border-top: 4px solid #000; padding-top: 30px;">
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 11px; font-weight: bold; font-family: monospace; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                            Customer Verification Name / ID
                        </label>
                        <input type="text" name="customer_name" required autocomplete="off" placeholder="Enter Your Name / ID" 
                               style="width: 100%; padding: 14px; font-size: 16px; border: 3px solid #000; box-sizing: border-box; font-family: monospace; background: #fff; outline: none; font-weight: bold;">
                    </div>

                    <button type="submit" name="finalize_order" 
                            style="width: 100%; background: #000; color: #fff; padding: 18px; font-size: 16px; font-weight: bold; border: 3px solid #000; cursor: pointer; text-transform: uppercase; font-family: sans-serif; letter-spacing: 1px; box-shadow: 4px 4px 0px #aaa;">
                        Finalize All Orders
                    </button>
                </form>

            <?php else: ?>
                <div style="padding: 40px; text-align: center; font-family: monospace; font-weight: bold; color: #777; border: 2px dashed #ccc;">
                    🛒 YOUR SHOPPING CART IS CURRENTLY EMPTY
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>
<?php $conn->close(); ?>