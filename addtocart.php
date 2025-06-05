<?php
// session_start();
require_once 'includes/dbh.inc.php';
if (isset($_POST['submit'])) {
    $item_id = $_POST['item_id'];

    // Fetch item details from the DB
    $sql = "SELECT img_name, price, calories FROM image WHERE img_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $item_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $cartItem = [
            'id' => $item_id,
            'name' => $row['img_name'],
            'price' => $row['price'],
            'calories' => $row['calories'],
            'quantity' => 1
        ];

        // Initialize cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Use item_id as key for easy updates/removals
        if (isset($_SESSION['cart'][$item_id])) {
            // If item already exists, increment quantity
            $_SESSION['cart'][$item_id]['quantity'] += 1;
        } else {
            // Add new item
            $_SESSION['cart'][$item_id] = $cartItem;
        }
        echo json_encode(['success' => true, 'message' => 'Item added to cart']);
        exit();
    }

}
echo json_encode(['success' => false, 'message' => 'Failed to add item']);
exit();
?>

