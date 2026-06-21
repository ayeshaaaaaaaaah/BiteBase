// Use this logic to CHANGE the status of an existing order
if(isset($_GET['id']) && isset($_GET['new_status'])) {
    $id = intval($_GET['id']);
    $status = $conn->real_escape_string($_GET['new_status']);
    
    $conn->query("UPDATE orders SET status = '$status' WHERE id = $id");
    header("Location: manager.php");
}