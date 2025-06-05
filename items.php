<?php
require_once 'includes/dbh.inc.php';
if (!isset($_SESSION['user_id'])) {
    // User not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
include_once 'headerordernow.php';

// Fetch categories
$navSql = "SELECT DISTINCT category FROM image ORDER BY category ASC";
$navResult = mysqli_query($conn, $navSql);

// Fetch food items including their ID
$itemSql = "SELECT img_id, img_name, img_path, price, calories, category FROM image ORDER BY img_id ASC";
$itemResult = mysqli_query($conn, $itemSql);
?>

<!-- NAVBAR -->
<nav class="navbar">
    <ul class="navbar-list">
        <?php while ($nav = mysqli_fetch_assoc($navResult)): ?>
            <li class="navbar-item">
                <a href="#" class="navbar-link" data-filter="<?php echo strtolower($nav['category']); ?>">
                    <?php echo ucfirst($nav['category']); ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</nav>

<!-- Back Button -->
<button onclick="history.back()" class="buttonborderless">
    <svg class="returnicon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
</svg>

</button>

<!-- ITEMS GRID -->
<?php if (mysqli_num_rows($itemResult) > 0): ?>
    <div class="item-grid">
        <?php while ($item = mysqli_fetch_assoc($itemResult)): ?>
            <div class="item" data-category="<?php echo strtolower($item['category']); ?>">
            <form action="addtocart.php" method="POST" class="add-to-cart-form">
                    <div class="itemimg">
                        <img src="<?php echo htmlspecialchars($item['img_path']); ?>" 
                             alt="<?php echo htmlspecialchars($item['img_name']); ?>" class="imgedit">
                        <button type="button" class="description" name="description">
                            <svg class="descriptionicon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021
                                      M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="name">
                        <?php echo htmlspecialchars($item['img_name']); ?><br>
                        £<?php echo number_format($item['price'], 2); ?> | <?php echo htmlspecialchars($item['calories']); ?> cal
                    </div>

                    <!-- ✅ Hidden input for item ID -->
                    <input type="hidden" name="item_id" value="<?php echo $item['img_id']; ?>">

                    <button type="submit" class="addToCart" name="submit">
                        <svg class="addtocartbtn" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                    </button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>No items found.</p>
<?php endif; ?>
<script src="cart.js"></script>
</body>
</html>
