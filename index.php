<?php
session_start();

// Connect to the database instance
$conn = new mysqli("localhost", "root", "", "bitebase");
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// 🎛️ Fetch unique cuisine options for the filter dropdown
$cuisine_check = $conn->query("SHOW COLUMNS FROM `restaurant` LIKE 'cuisine'");
$cuisine_column = ($cuisine_check && $cuisine_check->num_rows > 0) ? "cuisine" : "cuisine_type";

$dropdown_query = "SELECT DISTINCT `$cuisine_column` FROM restaurant WHERE `$cuisine_column` IS NOT NULL AND `$cuisine_column` != ''";
$dropdown_res = $conn->query($dropdown_query);

// 🛒 Handle Filter submission logic
$selected_cuisine = isset($_GET['cuisine_filter']) ? $conn->real_escape_string($_GET['cuisine_filter']) : '';

// Count total standalone items inside the cart session for the top-right indicator badge
$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += ($item['quantity'] ?? 1);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BiteBase | Discover Flavors</title>
</head>
<body style="background-color: #f4f4f4; margin: 0; padding: 40px 0; font-family: Arial, sans-serif;">

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">

        <div style="background: #000; color: #fff; padding: 25px; margin-bottom: 35px; display: flex; justify-content: space-between; align-items: center; border: 4px solid #000; box-shadow: 6px 6px 0px #000;">
            <div>
                <h1 style="margin: 0; font-size: 28px; font-weight: 900; letter-spacing: 1px; text-transform: uppercase; display: inline-block;">
                    🍔 BITEBASE
                </h1>
            </div>
            
            <div style="display: flex; gap: 15px; align-items: center;">
                <a href="view_cart.php" 
                   style="background: #10b981; color: #000; text-decoration: none; padding: 10px 20px; font-family: monospace; font-size: 12px; font-weight: bold; border: 3px solid #10b981; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 4px 4px 0px #333; display: flex; align-items: center; gap: 6px;">
                    🛒 VIEW CART (<?php echo $cart_count; ?>)
                </a>

                <a href="order.php" 
                   style="background: #fff; color: #000; text-decoration: none; padding: 10px 20px; font-family: monospace; font-size: 12px; font-weight: bold; border: 3px solid #fff; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 4px 4px 0px #333; display: flex; align-items: center; gap: 6px;">
                    MANAGER PORTAL →
                </a>
            </div>
        </div>

        <div style="background: #fff; border: 4px solid #000; padding: 25px; margin-bottom: 30px; box-shadow: 6px 6px 0px #000; position: relative; z-index: 10;">
            <form action="index.php" method="GET" style="display: flex; gap: 20px; align-items: center;">
                <div style="flex-grow: 1;">
                    <label style="display: block; font-family: monospace; font-weight: bold; font-size: 12px; text-transform: uppercase; margin-bottom: 8px;">
                        🎯 Search By Food Type
                    </label>
                    <select name="cuisine_filter" style="width: 100%; padding: 12px; font-size: 14px; font-weight: bold; font-family: monospace; border: 3px solid #000; outline: none; background: #fff; cursor: pointer;">
                        <option value="">-- Select a Cuisine Theme --</option>
                        <?php 
                        if ($dropdown_res && $dropdown_res->num_rows > 0) {
                            while($drop_row = $dropdown_res->fetch_assoc()) {
                                $val = $drop_row[$cuisine_column];
                                $selected = ($val === $selected_cuisine) ? 'selected' : '';
                                echo "<option value='".htmlspecialchars($val)."' $selected>".htmlspecialchars(strtoupper($val))."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" style="background: #000; color: #fff; padding: 14px 28px; font-size: 13px; font-weight: bold; font-family: monospace; border: 3px solid #000; cursor: pointer; text-transform: uppercase; margin-top: 22px;">
                    Apply Filter
                </button>
                <?php if (!empty($selected_cuisine)): ?>
                    <a href="index.php" style="background: #ef4444; color: #fff; text-decoration: none; padding: 14px 24px; font-size: 13px; font-weight: bold; font-family: monospace; border: 3px solid #000; text-transform: uppercase; margin-top: 22px;">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <?php
        if (!empty($selected_cuisine)) {
            $main_query = "SELECT * FROM restaurant WHERE `$cuisine_column` = '$selected_cuisine' ORDER BY id ASC";
        } else {
            $main_query = "SELECT * FROM restaurant ORDER BY id ASC";
        }
        $venues_res = $conn->query($main_query);
        $total_found = $venues_res ? $venues_res->num_rows : 0;
        ?>

        <h2 style="font-size: 18px; font-weight: bold; font-family: monospace; text-transform: uppercase; margin-bottom: 25px;">
            🏢 Registered Venues (<?php echo $total_found; ?> Found)
        </h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;">
            <?php if ($total_found > 0): ?>
                <?php while($venue = $venues_res->fetch_assoc()): 
                    $display_cuisine = 'General';
                    if (isset($venue['cuisine']) && !empty($venue['cuisine'])) {
                        $display_cuisine = $venue['cuisine'];
                    } elseif (isset($venue['cuisine_type']) && !empty($venue['cuisine_type'])) {
                        $display_cuisine = $venue['cuisine_type'];
                    }
                ?>
                    <div style="background: #fff; border: 4px solid #000; padding: 25px; box-shadow: 8px 8px 0px #000; display: flex; flex-direction: column; justify-content: space-between; position: relative;">
                        
                        <span style="position: absolute; top: 20px; right: 20px; background: #000; color: #fff; font-family: monospace; font-size: 11px; font-weight: bold; padding: 4px 8px;">
                            ID: <?php echo $venue['id']; ?>
                        </span>

                        <div style="margin-bottom: 25px;">
                            <h3 style="margin: 0 0 10px 0; font-size: 24px; font-weight: 900; text-transform: uppercase; padding-right: 50px;">
                                <?php echo htmlspecialchars($venue['name']); ?>
                            </h3>
                            <p style="margin: 0; color: #555; font-size: 14px; font-family: sans-serif;">
                                📍 Located in <strong style="color: #000;"><?php echo htmlspecialchars($venue['location'] ?? 'Local Feed'); ?></strong>
                            </p>
                        </div>

                        <div style="border-top: 2px dashed #000; padding-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span style="display: block; font-size: 9px; font-family: monospace; color: #888; text-transform: uppercase; font-weight: bold; margin-bottom: 4px;">
                                    Cuisine Type
                                </span>
                                <span style="display: inline-block; border: 2px solid #000; padding: 4px 10px; font-size: 12px; font-family: monospace; font-weight: bold; background: #f9f9f9; text-transform: uppercase;">
                                    <?php echo htmlspecialchars($display_cuisine); ?>
                                </span>
                            </div>

                            <a href="menu.php?restaurant_id=<?php echo $venue['id']; ?>" 
                               style="background: #000; color: #fff; text-decoration: none; padding: 12px 20px; font-size: 12px; font-weight: bold; font-family: monospace; text-transform: uppercase; border: 3px solid #000; box-shadow: 3px 3px 0px #aaa;">
                                View Menu →
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; padding: 60px; text-align: center; font-family: monospace; font-weight: bold; color: #777; border: 3px dashed #ccc; background: #fff;">
                    🔍 NO MATCHING RESTAURANTS FOUND UNDER THIS CRITERIA
                </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 150px;"></div>

    </div>

</body>
</html>
<?php $conn->close(); ?>