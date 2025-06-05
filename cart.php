<?php
require_once 'includes/dbh.inc.php';
if (!isset($_SESSION['user_id'])) {
    // User not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
// Handle POST actions for increase, decrease, remove, checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $img_id = $_POST['img_id'] ?? null;

    if ($img_id && isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'increase':
                if (isset($_SESSION['cart'][$img_id])) {
                    $_SESSION['cart'][$img_id]['quantity'] += 1;
                }
                break;
            case 'decrease':
                if (isset($_SESSION['cart'][$img_id])) {
                    $_SESSION['cart'][$img_id]['quantity'] -= 1;
                    if ($_SESSION['cart'][$img_id]['quantity'] <= 0) {
                        unset($_SESSION['cart'][$img_id]);
                    }
                }
                break;
            case 'remove':
                if (isset($_SESSION['cart'][$img_id])) {
                    unset($_SESSION['cart'][$img_id]);
                }
                break;
            case 'checkout':
                header("Location: checkout.php");
                exit();
        }
    }
    header("Location: cart.php");
    exit();
}

include_once 'headerordernow.php';
?>

<div class="cart-container">
    <h2>Your Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['cart'] as $item_id => $item): ?>
            <?php 
                $name = $item['name'] ?? 'Unknown Item';
                $price = isset($item['price']) ? (float)$item['price'] : 0.00;
                $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
                $calories = $item['calories'] ?? 'N/A';

                $subtotal = $price * $quantity; 
                $total += $subtotal; 
            ?>
            <div class="cart-item">
                <div class="item-details">
                    <strong><?php echo htmlspecialchars($name); ?></strong><br>
                    £<?php echo number_format($price, 2); ?> × <?php echo $quantity; ?> = 
                    <span class="subtotal">£<?php echo number_format($subtotal, 2); ?></span><br>
                    <?php echo htmlspecialchars($calories); ?> cal
                </div>
                <div class="cart-actions">
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="img_id" value="<?php echo htmlspecialchars($item_id); ?>">
                        <button class="btn" name="action" value="increase" type="submit">+</button>
                        <button class="btn" name="action" value="decrease" type="submit">−</button>
                        <button class="btn" name="action" value="remove" type="submit">Remove</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="total"><strong>Total: £<?php echo number_format($total, 2); ?></strong></div>
        <form action="checkout.php"method="POST">
            <button type="submit" class="checkout-btn" name="action" value="checkout">Checkout</button>
        </form>
    <?php else: ?>
        <p class="empty-message">Your cart is empty.</p>
    <?php endif; ?>
</div>

<!-- Fixed Back Button -->
<button class="back-button" onclick="window.location.href='ordernow.php'; return false;">Back</button>

</body>
</html>
