<?php
// 1. Initialize session to access the active cart array
session_start();

// 2. Check if the specific array key parameter is passed in the URL link
if (isset($_GET['item_key'])) {
    $key_to_remove = $_GET['item_key'];

    // 3. Verify if that specific item key actually exists inside the cart array session
    if (isset($_SESSION['cart'][$key_to_remove])) {
        
        // Unset drops that specific array index from memory completely
        unset($_SESSION['cart'][$key_to_remove]);
        
        // Re-index the array keys so there are no empty gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// 4. Silently redirect back to the cart interface view
header("Location: view_cart.php");
exit();
?>