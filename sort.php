<?php
require_once 'includes/ordernow.inc.php';
include_once 'headerordernow.php';

$sortOption = isset($_POST['sort_option']) ? $_POST['sort_option'] : null;
?>

<div class="sort-options-container">
  <form action="sort.php" method="POST" class="sort-options-form">
    <label><input type="radio" name="sort_option" value="price_low" required> Price: Low to High</label>
    <label><input type="radio" name="sort_option" value="price_high"> Price: High to Low</label>
    <label><input type="radio" name="sort_option" value="calories_low"> Calories: Low to High</label>
    <label><input type="radio" name="sort_option" value="calories_high"> Calories: High to Low</label>
    <label><input type="radio" name="sort_option" value="name_az"> Name: A–Z</label>
    <label><input type="radio" name="sort_option" value="name_za"> Name: Z–A</label>
    <button type="submit" class="go-btn">Go</button>
  </form>
</div>

<?php
if ($sortOption) {
    echo '<div class="active-sort-bar">';
    echo "<span>Sorted by: " . htmlspecialchars(str_replace('_', ' ', ucfirst($sortOption))) . "</span>";
    echo '<form action="sort.php" method="POST" style="display:inline;">
            <button type="submit" class="cancel-btn">× Cancel</button>
          </form>';
    echo '</div>';
}

// Default query
$sql = "SELECT * FROM image";

switch ($sortOption) {
    case 'price_low':
        $sql .= " ORDER BY price ASC";
        break;
    case 'price_high':
        $sql .= " ORDER BY price DESC";
        break;
    case 'calories_low':
        $sql .= " ORDER BY calories ASC";
        break;
    case 'calories_high':
        $sql .= " ORDER BY calories DESC";
        break;
    case 'name_az':
        $sql .= " ORDER BY img_name ASC";
        break;
    case 'name_za':
        $sql .= " ORDER BY img_name DESC";
        break;
}
$result = mysqli_query($conn, $sql);

echo '<div class="item-grid">';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="item" data-category="<?php echo strtolower($row['category']); ?>">
            <div class="itemimg">
                <img src="<?php echo htmlspecialchars($row['img_path']); ?>" alt="<?php echo htmlspecialchars($row['img_name']); ?>" class="imgedit">
                <button type="submit" class="description" name="submit">
                    <svg class="descriptionicon" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021
                              M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                    </svg>
                </button>
            </div>
            <div class="name">
                <?php echo htmlspecialchars($row['img_name']); ?><br>
                £<?php echo number_format($row['price'], 2); ?> | <?php echo htmlspecialchars($row['calories']); ?> cal
            </div>
            <button type="submit" class="addToCart" name="submit">
                <svg class="addtocartbtn" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
            </button>
        </div>
        <?php
    }
} else {
    echo "<p>No items found.</p>";
}
echo '</div>';
?>
