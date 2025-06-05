<?php
require_once 'includes/dbh.inc.php';

// Check if an item is added to the cart
if (isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Get the item details
    $query = "SELECT * FROM image WHERE img_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $item_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($record = mysqli_fetch_assoc($result)) {
        // Add the item to the session cart
        $item = [
            'id' => $item_id,
            'name' => $record['img_name'],
            'price' => $record['price'], // Assuming a 'price' column exists
            'quantity' => $quantity
        ];

        $_SESSION['cart'][] = $item;

        // Redirect to the menu or order page
        header("Location: ../menu.php");
        exit();
    } else {
        $_SESSION['error'] = "Item not found.";
        header("Location: ../menu.php");
        exit();
    }
}

// Handle the order submission
if (isset($_POST['place_order'])) {
    $user_id = $_SESSION['user_id'];
    $total_price = $_POST['total_price'];
    $items = $_SESSION['cart'];

    // Insert the order into the database
    $query = "INSERT INTO orders (user_id, total_price, order_date) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'id', $user_id, $total_price);
    mysqli_stmt_execute($stmt);

    // Get the order ID
    $order_id = mysqli_insert_id($conn);

    // Insert order items into the order_items table
    foreach ($items as $item) {
        $query = "INSERT INTO order_items (order_id, item_id, quantity) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'iii', $order_id, $item['id'], $item['quantity']);
        mysqli_stmt_execute($stmt);
    }

    // Clear the cart session
    unset($_SESSION['cart']);
    $_SESSION['success'] = "Your order has been placed successfully!";
    header("Location: ../menu.php");
    exit();
}
?>

