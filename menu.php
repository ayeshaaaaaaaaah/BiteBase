<?php
// Start session storage configuration
session_start();

// Connect to the backend instance
$conn = new mysqli("localhost", "root", "", "bitebase");
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Fetch routing parameters cleanly
$restaurant_id = isset($_GET['restaurant_id']) ? intval($_GET['restaurant_id']) : 1;

// Fetch metadata parameters matching restaurant index
$rest_query = "SELECT * FROM restaurant WHERE id = $restaurant_id";
$rest_res = $conn->query($rest_query);
$restaurant = $rest_res ? $rest_res->fetch_assoc() : ['name' => 'Selected Venue'];

// ========================================================
// ⚡ HANDLE SYNCED ADD / UPDATE / SUBTRACT CART PROCESSING
// ========================================================
if (isset($_GET['action']) && $_GET['action'] === 'update_cart') {
    $item_name = $_GET['item_name'];
    $item_price = floatval($_GET['item_price']);
    $change = intval($_GET['change']); // +1 or -1 operator
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if the item already exists in our shopping cart structure
    $found_key = -1;
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['name'] === $item_name) {
            $found_key = $key;
            break;
        }
    }
    
    if ($found_key !== -1) {
        // Item found: adjust quantity up or down
        $_SESSION['cart'][$found_key]['quantity'] += $change;
        
        // If quantity falls to 0 or lower, remove it from the cart array cleanly
        if ($_SESSION['cart'][$found_key]['quantity'] <= 0) {
            unset($_SESSION['cart'][$found_key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset numeric index matching arrays
        }
    } else if ($change > 0) {
        // Item doesn't exist and we are adding it for the first time
        $_SESSION['cart'][] = [
            'name' => $item_name,
            'price' => $item_price,
            'quantity' => 1
        ];
    }
    
    // Redirect cleanly right back to the current venue view to show the new quantities
    header("Location: menu.php?restaurant_id=" . $restaurant_id);
    exit();
}

// Helper function to figure out exactly how many of this item are in the session cart
function getItemQuantityInCart($name) {
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) return 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['name'] === $name) {
            return $cart_item['quantity'];
        }
    }
    return 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($restaurant['name']); ?> | Menu</title>
</head>
<body style="background-color: #f4f4f4; margin: 0; padding: 40px 0; font-family: Arial, sans-serif;">

    <!-- 👑 SYSTEM STRUCTURAL CONTAINER -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">

        <!-- HEADER PLATFORM BRANDING LAYOUT -->
        <div style="background: #fff; padding: 25px; margin-bottom: 35px; display: flex; justify-content: space-between; align-items: center; border: 4px solid #000; box-shadow: 6px 6px 0px #000;">
            <div>
                <a href="index.php" style="color: #000; text-decoration: none; font-weight: bold; font-family: monospace; font-size: 13px; text-transform: uppercase; display: inline-block; margin-bottom: 5px;">
                    ← Back to Restaurants
                </a>
                <h1 style="margin: 0; font-size: 28px; font-weight: 900; text-transform: uppercase; font-family: sans-serif;">
                    🍱 <?php echo htmlspecialchars($restaurant['name']); ?>
                </h1>
            </div>
            
            <a href="view_cart.php" 
               style="background: #000; color: #fff; text-decoration: none; padding: 14px 28px; font-family: monospace; font-size: 13px; font-weight: bold; border: 3px solid #000; text-transform: uppercase; box-shadow: 4px 4px 0px #aaa;">
                🛒 VIEW CART (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
            </a>
        </div>

        <!-- AVAILABLE DISHES GRID SYSTEM -->
        <h2 style="font-weight: bold; font-family: monospace; text-transform: uppercase; margin-bottom: 25px;">
            📋 AVAILABLE DISHES
        </h2>

        <?php
        $menu_query = "SELECT * FROM menu WHERE restaurant_id = $restaurant_id";
        $menu_res = $conn->query($menu_query);
        ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(500px, 1fr)); gap: 25px;">
            <?php if ($menu_res && $menu_res->num_rows > 0): ?>
                <?php while($dish = $menu_res->fetch_assoc()): 
                    // 🔍 SAFE COLUMN FALLBACK CHECK: Tries 'name', then 'item_name', then falls back to 'dish_name'
                    $display_name = '';
                    if (isset($dish['name'])) {
                        $display_name = $dish['name'];
                    } elseif (isset($dish['item_name'])) {
                        $display_name = $dish['item_name'];
                    } else {
                        $display_name = isset($dish['dish_name']) ? $dish['dish_name'] : 'Unknown Dish';
                    }

                    $current_qty = getItemQuantityInCart($display_name);
                ?>
                    <div style="background: #fff; border: 4px solid #000; padding: 25px; box-shadow: 6px 6px 0px #000; display: flex; justify-content: space-between; align-items: center;">
                        
                        <div>
                            <h3 style="margin: 0 0 8px 0; font-size: 20px; font-weight: bold; text-transform: uppercase;">
                                <?php echo htmlspecialchars($display_name); ?>
                            </h3>
                            <span style="font-size: 18px; font-weight: bold; color: #10b981; font-family: monospace;">
                                Rs. <?php echo number_format($dish['price']); ?>
                            </span>
                        </div>

                        <!-- 🎛️ DYNAMIC QUANTITY CONTROLLER BLOCK -->
                        <div>
                            <?php if ($current_qty > 0): ?>
                                <div style="display: flex; border: 3px solid #000; background: #fff; box-shadow: 3px 3px 0px #000; align-items: center;">
                                    
                                    <!-- Decrement Button Link -->
                                    <a href="menu.php?restaurant_id=<?php echo $restaurant_id; ?>&action=update_cart&item_name=<?php echo urlencode($display_name); ?>&item_price=<?php echo $dish['price']; ?>&change=-1" 
                                       style="background: #fff; color: #000; text-decoration: none; font-weight: bold; font-size: 18px; padding: 8px 16px; border-right: 3px solid #000; font-family: monospace; text-align: center; width: 15px; display: inline-block;">
                                        -
                                    </a>
                                    
                                    <!-- Active Quantity Count -->
                                    <div style="padding: 8px 16px; font-weight: bold; font-family: monospace; font-size: 15px; min-width: 20px; text-align: center; color: #000;">
                                        <?php echo $current_qty; ?>
                                    </div>
                                    
                                    <!-- Increment Button Link -->
                                    <a href="menu.php?restaurant_id=<?php echo $restaurant_id; ?>&action=update_cart&item_name=<?php echo urlencode($display_name); ?>&item_price=<?php echo $dish['price']; ?>&change=1" 
                                       style="background: #000; color: #fff; text-decoration: none; font-weight: bold; font-size: 18px; padding: 8px 16px; border-left: 3px solid #000; font-family: monospace; text-align: center; width: 15px; display: inline-block;">
                                        +
                                    </a>
                                    
                                </div>
                            <?php else: ?>
                                <!-- Standard Add To Cart Button -->
                                <a href="menu.php?restaurant_id=<?php echo $restaurant_id; ?>&action=update_cart&item_name=<?php echo urlencode($display_name); ?>&item_price=<?php echo $dish['price']; ?>&change=1" 
                                   style="background: #000; color: #fff; text-decoration: none; padding: 12px 24px; font-size: 12px; font-weight: bold; text-transform: uppercase; border: 3px solid #000; display: inline-block; box-shadow: 3px 3px 0px #aaa; font-family: sans-serif; letter-spacing: 0.5px;">
                                    Add To Cart
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; padding: 40px; text-align: center; font-family: monospace; font-weight: bold; color: #777; border: 3px dashed #ccc; background: #fff;">
                    🍽️ NO DISHES LOGGED ON THIS MENU YET
                </div>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>
<?php $conn->close(); ?>