<?php
require_once 'includes/dbh.inc.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Check if phone number and delivery address are set in the session
$phone = $_SESSION['phone_number'] ?? '';
$address = $_SESSION['delivery_address'] ?? '';

// If either phone number or address is missing, show JS alert and redirect
if (empty($phone) || empty($address)) {
    echo "<script>
        alert('Please update your phone number and delivery address before placing an order.');
        window.location.href = 'profile.php';
    </script>";
    exit();
}


// Check if cart is empty
if (empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit();
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $price = isset($item['price']) ? (float)$item['price'] : 0;
    $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
    $total_price += $price * $quantity;
}

$status = 'pending'; // default order status

// Start transaction
$conn->begin_transaction();

try {
    // Insert into orders table
    $sql = "INSERT INTO orders (user_id, total_price, status, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

    $stmt->bind_param("ids", $user_id, $total_price, $status);
    if (!$stmt->execute()) throw new Exception("Execute failed: " . $stmt->error);

    $order_id = $stmt->insert_id; // get the inserted order id
    $stmt->close();

    // Insert each item into order_items table
    $sql_item = "INSERT INTO order_items (order_id, img_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt_item = $conn->prepare($sql_item);
    if (!$stmt_item) throw new Exception("Prepare failed: " . $conn->error);

    foreach ($_SESSION['cart'] as $img_id => $item) {
        $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
        $price = isset($item['price']) ? (float)$item['price'] : 0;

        $stmt_item->bind_param("iiid", $order_id, $img_id, $quantity, $price);
        if (!$stmt_item->execute()) throw new Exception("Execute failed: " . $stmt_item->error);
    }

    $stmt_item->close();

    // Commit transaction
    $conn->commit();

    // Clear cart session
    unset($_SESSION['cart']);

    // Redirect to success page
    header("Location: ordersuccess.php");
    exit();

} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    echo "<p>Error placing order: " . $e->getMessage() . "</p>";
    echo '<p><a href="cart.php">Return to Cart</a></p>';
}

$conn->close();
?>
